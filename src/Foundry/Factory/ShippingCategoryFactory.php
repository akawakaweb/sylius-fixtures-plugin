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

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShippingCategoryDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShippingCategoryUpdaterInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ShippingCategoryRepository;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Shipping\Model\ShippingCategory;
use Sylius\Component\Shipping\Model\ShippingCategoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ShippingCategoryInterface>
 *
 * @method        ShippingCategoryInterface|Proxy create(array|callable $attributes = [])
 * @method static ShippingCategoryInterface|Proxy createOne(array $attributes = [])
 * @method static ShippingCategoryInterface|Proxy find(object|array|mixed $criteria)
 * @method static ShippingCategoryInterface|Proxy findOrCreate(array $attributes)
 * @method static ShippingCategoryInterface|Proxy first(string $sortedField = 'id')
 * @method static ShippingCategoryInterface|Proxy last(string $sortedField = 'id')
 * @method static ShippingCategoryInterface|Proxy random(array $attributes = [])
 * @method static ShippingCategoryInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static ShippingCategoryRepository|RepositoryProxy repository()
 * @method static ShippingCategoryInterface[]|Proxy[] all()
 * @method static ShippingCategoryInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ShippingCategoryInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ShippingCategoryInterface[]|Proxy[] findBy(array $attributes)
 * @method static ShippingCategoryInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ShippingCategoryInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ShippingCategoryFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithDescriptionTrait;

    public function __construct(
        private FactoryInterface $factory,
        private ShippingCategoryDefaultValuesInterface $defaultValues,
        private ShippingCategoryTransformerInterface $transformer,
        private ShippingCategoryUpdaterInterface $updater,
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
            ->instantiateWith(function (): ShippingCategoryInterface {
                /** @var ShippingCategoryInterface $shippingCategory */
                $shippingCategory = $this->factory->createNew();

                return $shippingCategory;
            })
            ->afterInstantiate(function (ShippingCategory $shippingCategory, array $attributes): void {
                $this->updater->update($shippingCategory, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? ShippingCategory::class;
    }
}
