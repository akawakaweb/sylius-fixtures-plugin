<?php

/*
 * This file is part of SyliusFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAttributeFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductOptionFactory;
use Faker\Factory;
use Faker\Generator;
use Sylius\Component\Attribute\AttributeType\SelectAttributeType;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Product\Generator\SlugGeneratorInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Product\Model\ProductAttributeValueInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;
use Zenstruck\Foundry\Proxy;

final class ProductTransformer implements TransformerInterface
{
    use TransformTaxonAttributeTrait;
    use TransformTaxCategoryAttributeTrait;
    use TransformChannelsAttributeTrait;
    use TransformTaxaAttributeTrait;
    use TransformNameToCodeAttributeTrait;
    use TransformNameToSlugAttributeTrait;

    private Generator $faker;

    public function __construct(
        private SlugGeneratorInterface $slugGenerator,
        private FactoryInterface $productAttributeValueFactory,
    ) {
        $this->faker = Factory::create();
    }

    public function transform(array $attributes): array
    {
        $attributes = $this->transformTaxonAttribute($attributes, 'mainTaxon');
        $attributes = $this->transformTaxCategoryAttribute($attributes);
        $attributes = $this->transformProductAttributeValues($attributes);
        $attributes = $this->transformProductOptionsAttribute($attributes);
        $attributes = $this->transformChannelsAttribute($attributes);
        $attributes = $this->transformTaxaAttribute($attributes);
        $attributes = $this->transformNameToCodeAttribute($attributes);

        return $this->transformNameToSlugAttribute($attributes, $this->slugGenerator);
    }

    private function transformProductOptionsAttribute(array $attributes): array
    {
        $productOptions = &$attributes['productOptions'];

        /**
         * @var int $key
         * @var mixed $option
         */
        foreach ($productOptions ?? [] as $key => $option) {
            if (\is_string($option)) {
                $productOptions[$key] = ProductOptionFactory::findOrCreate(['code' => $option]);
            }
        }

        return $attributes;
    }

    private function transformProductAttributeValues(array $attributes): array
    {
        $productAttributesValues = [];
        /**
         * @var string $code
         * @var mixed $value
         */
        foreach ($attributes['productAttributes'] ?? [] as $code => $value) {
            /** @var Proxy<ProductAttributeInterface> $productAttribute */
            $productAttribute = ProductAttributeFactory::findOrCreate(['code' => $code]);

            if (!$productAttribute->isTranslatable()) {
                $productAttributesValues[] = $this->configureProductAttributeValue($productAttribute->object(), null, $value);

                continue;
            }

            /** @var Proxy<LocaleInterface> $locale */
            foreach (LocaleFactory::all() as $locale) {
                $localeCode = $locale->getCode() ?? '';
                $productAttributesValues[] = $this->configureProductAttributeValue($productAttribute->object(), $localeCode, $value);
            }
        }

        $attributes['productAttributes'] = $productAttributesValues;

        return $attributes;
    }

    private function configureProductAttributeValue(ProductAttributeInterface $productAttribute, ?string $localeCode, mixed $value): ProductAttributeValueInterface
    {
        /** @var ProductAttributeValueInterface $productAttributeValue */
        $productAttributeValue = $this->productAttributeValueFactory->createNew();
        $productAttributeValue->setAttribute($productAttribute);

        if ($value !== null && in_array($productAttribute->getStorageType(), [ProductAttributeValueInterface::STORAGE_DATE, ProductAttributeValueInterface::STORAGE_DATETIME], true)) {
            Assert::string($value);
            $value = new \DateTime($value);
        }

        $productAttributeValue->setValue($value ?? $this->getRandomValueForProductAttribute($productAttribute));
        $productAttributeValue->setLocaleCode($localeCode);

        return $productAttributeValue;
    }

    /**
     * @throws \BadMethodCallException
     */
    private function getRandomValueForProductAttribute(ProductAttributeInterface $productAttribute): mixed
    {
        switch ($productAttribute->getStorageType()) {
            case ProductAttributeValueInterface::STORAGE_BOOLEAN:
                return $this->faker->boolean;
            case ProductAttributeValueInterface::STORAGE_INTEGER:
                return $this->faker->numberBetween(0, 10000);
            case ProductAttributeValueInterface::STORAGE_FLOAT:
                return $this->faker->randomFloat(4, 0, 10000);
            case ProductAttributeValueInterface::STORAGE_TEXT:
                return $this->faker->sentence;
            case ProductAttributeValueInterface::STORAGE_DATE:
            case ProductAttributeValueInterface::STORAGE_DATETIME:
                return $this->faker->dateTimeThisCentury;
            case ProductAttributeValueInterface::STORAGE_JSON:
                if ($productAttribute->getType() === SelectAttributeType::TYPE) {
                    if ($productAttribute->getConfiguration()['multiple']) {
                        return $this->faker->randomElements(
                            array_keys($productAttribute->getConfiguration()['choices']),
                            $this->faker->numberBetween(1, count($productAttribute->getConfiguration()['choices'])),
                        );
                    }

                    return [$this->faker->randomKey($productAttribute->getConfiguration()['choices'])];
                }
                // no break
            default:
                throw new \BadMethodCallException();
        }
    }
}
