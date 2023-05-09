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

use Faker\Factory;
use Faker\Generator;
use Sylius\Component\Core\Model\ChannelInterface;
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
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Webmozart\Assert\Assert;

final class ProductInitiator implements InitiatorInterface
{
    private Generator $faker;

    public function __construct(
        private FactoryInterface $productFactory,
        private RepositoryInterface $localeRepository,
        private FactoryInterface $productVariantFactory,
        private FactoryInterface $channelPricingFactory,
        private ProductVariantGeneratorInterface $variantGenerator,
        private RepositoryInterface $channelRepository,
        private FactoryInterface $productTaxonFactory,
        private FactoryInterface $productImageFactory,
        private FileLocatorInterface $fileLocator,
        private ImageUploaderInterface $imageUploader,
    ) {
        $this->faker = Factory::create();
    }

    public function __invoke(array $attributes, string $class): object
    {
        $product = $this->productFactory->createNew();
        Assert::isInstanceOf($product, ProductInterface::class);

        $product->setCode($attributes['code'] ?? null);
        $product->setVariantSelectionMethod($attributes['variantSelectionMethod'] ?? null);
        $product->setEnabled($attributes['enabled']);
        $product->setMainTaxon($attributes['mainTaxon'] ?? null);
        $product->setCreatedAt($this->faker->dateTimeBetween('-1 week', 'now'));

        $this->createTranslations($product, $attributes);
        $this->createRelations($product, $attributes);
        $this->createVariants($product, $attributes);
        $this->createImages($product, $attributes);
        $this->createProductTaxa($product, $attributes);

        return $product;
    }

    private function createTranslations(ProductInterface $product, array $attributes): void
    {
        /** @var string $localeCode */
        foreach ($this->getLocales() as $localeCode) {
            $product->setCurrentLocale($localeCode);
            $product->setFallbackLocale($localeCode);

            $product->setName($attributes['name'] ?? null);
            $product->setSlug($attributes['slug'] ?? null);
            $product->setShortDescription($attributes['shortDescription'] ?? null);
            $product->setDescription($attributes['description'] ?? null);
        }
    }

    private function createRelations(ProductInterface $product, array $attributes): void
    {
        /** @var ChannelInterface $channel */
        foreach ($attributes['channels'] ?? [] as $channel) {
            $product->addChannel($channel);
        }

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

            /** @var ChannelInterface $channel */
            foreach ($this->channelRepository->findAll() as $channel) {
                $this->createChannelPricings($productVariant, $channel->getCode() ?? '');
            }

            ++$i;
        }
    }

    private function createImages(ProductInterface $product, array $attributes): void
    {
        /** @var array $image */
        foreach ($attributes['images'] ?? [] as $image) {
            if (!array_key_exists('path', $image)) {
                @trigger_error(
                    'It is deprecated since Sylius 1.3 to pass indexed array as an image definition. ' .
                    'Please use associative array with "path" and "type" keys instead.',
                    \E_USER_DEPRECATED,
                );

                /** @var string $imagePath */
                $imagePath = array_shift($image);

                /** @var string|null $imageType */
                $imageType = array_pop($image);
            } else {
                /** @var string $imagePath */
                $imagePath = $image['path'];

                /** @var string|null $imageType */
                $imageType = $image['type'] ?? null;
            }

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

    private function getLocales(): iterable
    {
        /** @var LocaleInterface[] $locales */
        $locales = $this->localeRepository->findAll();
        foreach ($locales as $locale) {
            yield $locale->getCode();
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
