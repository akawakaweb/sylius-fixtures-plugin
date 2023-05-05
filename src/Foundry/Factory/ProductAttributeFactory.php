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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductAttributeDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\TranslatableTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithConfigurationTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithTypeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductAttributeTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ProductAttributeUpdaterInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;
use Sylius\Component\Attribute\Factory\AttributeFactoryInterface;
use Sylius\Component\Product\Model\ProductAttribute;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ProductAttributeInterface>
 *
 * @method        ProductAttributeInterface|Proxy create(array|callable $attributes = [])
 * @method static ProductAttributeInterface|Proxy createOne(array $attributes = [])
 * @method static ProductAttributeInterface|Proxy find(object|array|mixed $criteria)
 * @method static ProductAttributeInterface|Proxy findOrCreate(array $attributes)
 * @method static ProductAttributeInterface|Proxy first(string $sortedField = 'id')
 * @method static ProductAttributeInterface|Proxy last(string $sortedField = 'id')
 * @method static ProductAttributeInterface|Proxy random(array $attributes = [])
 * @method static ProductAttributeInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static ProductAttributeInterface[]|Proxy[] all()
 * @method static ProductAttributeInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProductAttributeInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ProductAttributeInterface[]|Proxy[] findBy(array $attributes)
 * @method static ProductAttributeInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductAttributeInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProductAttributeFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithTypeTrait;
    use WithNameTrait;
    use TranslatableTrait;
    use WithConfigurationTrait;

    public function __construct(
        private AttributeFactoryInterface $factory,
        private ProductAttributeDefaultValuesInterface $defaultValues,
        private ProductAttributeTransformerInterface $transformer,
        private ProductAttributeUpdaterInterface $updater,
    ) {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return $this->defaultValues->getDefaultValues(self::faker());
    }

    protected function initialize(): self
    {
        return $this
            ->beforeInstantiate(function (array $attributes): array {
                return $this->transformer->transform($attributes);
            })
            ->instantiateWith(function (array $attributes): ProductAttributeInterface {
                /** @var string $type */
                $type = $attributes['type'] ?? TextAttributeType::TYPE;

                /** @var ProductAttributeInterface $productAttribute */
                $productAttribute = $this->factory->createTyped($type);

                return $productAttribute;
            })
            ->afterInstantiate(function (ProductAttribute $productAttribute, array $attributes): void {
                $this->updater->update($productAttribute, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? ProductAttribute::class;
    }
}
