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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\TranslatableTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithConfigurationTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithTypeTrait;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Product\Model\ProductAttribute;
use Sylius\Component\Product\Model\ProductAttributeInterface;
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
final class ProductAttributeFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithTypeTrait;
    use WithNameTrait;
    use TranslatableTrait;
    use WithConfigurationTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? ProductAttribute::class;
    }
}
