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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformerInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ShippingCategoryRepository;
use Sylius\Component\Shipping\Model\ShippingCategory;
use Sylius\Component\Shipping\Model\ShippingCategoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ShippingCategoryInterface>
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
        private ShippingCategoryTransformerInterface $transformer,
    ) {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'code' => null,
            'createdAt' => self::faker()->dateTime(),
            'name' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->beforeInstantiate(function (array $attributes): array {
                return $this->transformer->transform($attributes);
            })
            // ->afterInstantiate(function(ShippingCategory $shippingCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? ShippingCategory::class;
    }
}
