<?php

/*
 * This file is part of ShopFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Initiator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;
use Faker\Factory;
use Faker\Generator;
use Sylius\Component\Core\Model\ChannelPricingInterface;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTaxonInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Product\Generator\ProductVariantGeneratorInterface;
use Sylius\Component\Product\Model\ProductAttributeValueInterface;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Sylius\Component\Product\Model\ProductOptionValueInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Webmozart\Assert\Assert;

final class ProductInitiator implements InitiatorInterface
{
    private Generator $faker;

    public function __construct(
        private FactoryInterface $productFactory,
        private FactoryInterface $productVariantFactory,
        private FactoryInterface $channelPricingFactory,
        private ProductVariantGeneratorInterface $variantGenerator,
        private FactoryInterface $productTaxonFactory,
        private FactoryInterface $productImageFactory,
        private FileLocatorInterface $fileLocator,
        private ImageUploaderInterface $imageUploader,
        private UpdaterInterface $updater,
    ) {
        $this->faker = Factory::create();
    }

    public function __invoke(array $attributes, string $class): object
    {
        $product = $this->productFactory->createNew();
        Assert::isInstanceOf($product, ProductInterface::class);

        $this->createTranslations($product, $attributes);
        $this->createRelations($product, $attributes);
        $this->createVariants($product, $attributes);
        $this->createImages($product, $attributes);
        $this->createProductTaxa($product, $attributes);

        ($this->updater)($product, $attributes);

        return $product;
    }

    private function createTranslations(ProductInterface $product, array &$attributes): void
    {
        $name = $attributes['name'] ?? null;
        Assert::nullOrString($name);

        $slug = $attributes['slug'] ?? null;
        Assert::nullOrString($slug);

        $shortDescription = $attributes['shortDescription'] ?? null;
        Assert::nullOrString($shortDescription);

        $description = $attributes['description'] ?? null;
        Assert::nullOrString($description);

        /** @var LocaleInterface $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $product->setCurrentLocale($localeCode);
            $product->setFallbackLocale($localeCode);

            $product->setName($name);
            $product->setSlug($slug);
            $product->setShortDescription($shortDescription);
            $product->setDescription($description);
        }

        unset($attributes['name'], $attributes['slug'], $attributes['shortDescription'], $attributes['description']);
    }

    private function createRelations(ProductInterface $product, array $attributes): void
    {
        /** @var ProductOptionInterface $option */
        foreach ($attributes['productOptions'] ?? [] as $option) {
            $product->addOption($option);
        }

        /** @var ProductAttributeValueInterface $attribute */
        foreach ($attributes['productAttributes'] ?? [] as $attribute) {
            $product->addAttribute($attribute);
        }
    }

    private function createVariants(ProductInterface $product, array $options): void
    {
        try {
            $this->variantGenerator->generate($product);
        } catch (\InvalidArgumentException) {
            /** @var ProductVariantInterface $productVariant */
            $productVariant = $this->productVariantFactory->createNew();

            $product->addVariant($productVariant);
        }

        $i = 0;
        /** @var ProductVariantInterface $productVariant */
        foreach ($product->getVariants() as $productVariant) {
            $productVariant->setName($this->generateProductVariantName($productVariant));
            $productVariant->setCode(sprintf('%s-variant-%d', $options['code'], $i));
            $productVariant->setOnHand($this->faker->randomNumber(1));
            $productVariant->setShippingRequired($options['shippingRequired'] ?? true);
            if (isset($options['taxCategory']) && $options['taxCategory'] instanceof TaxCategoryInterface) {
                $productVariant->setTaxCategory($options['taxCategory']);
            }
            $productVariant->setTracked($options['tracked'] ?? false);

            foreach (ChannelFactory::all() as $channel) {
                $this->createChannelPricings($productVariant, $channel->getCode() ?? '');
            }

            ++$i;
        }
    }

    private function createImages(ProductInterface $product, array &$attributes): void
    {
        /** @var array $image */
        foreach ($attributes['images'] ?? [] as $image) {
            /** @var string $imagePath */
            $imagePath = $image['path'];

            /** @var string|null $imageType */
            $imageType = $image['type'] ?? null;

            /** @var string $imagePath */
            $imagePath = $this->fileLocator->locate($imagePath);
            $uploadedImage = new UploadedFile($imagePath, basename($imagePath));

            /** @var ImageInterface $productImage */
            $productImage = $this->productImageFactory->createNew();
            $productImage->setFile($uploadedImage);
            $productImage->setType($imageType);

            $this->imageUploader->upload($productImage);

            $product->addImage($productImage);
        }

        unset($attributes['images']);
    }

    private function createProductTaxa(ProductInterface $product, array $attributes): void
    {
        /** @var TaxonInterface $taxon */
        foreach ($attributes['taxa'] ?? $attributes['taxons'] ?? [] as $taxon) {
            /** @var ProductTaxonInterface $productTaxon */
            $productTaxon = $this->productTaxonFactory->createNew();
            $productTaxon->setProduct($product);
            $productTaxon->setTaxon($taxon);

            $product->addProductTaxon($productTaxon);
        }
    }

    private function createChannelPricings(ProductVariantInterface $productVariant, string $channelCode): void
    {
        /** @var ChannelPricingInterface $channelPricing */
        $channelPricing = $this->channelPricingFactory->createNew();
        $channelPricing->setChannelCode($channelCode);
        $channelPricing->setPrice($this->faker->numberBetween(100, 10000));

        $productVariant->addChannelPricing($channelPricing);
    }

    private function generateProductVariantName(ProductVariantInterface $variant): string
    {
        return trim(array_reduce(
            $variant->getOptionValues()->toArray(),
            static fn (?string $variantName, ProductOptionValueInterface $variantOption) => ($variantName ?? '') . sprintf('%s ', $variantOption->getValue() ?? ''),
            '',
        ));
    }
}
