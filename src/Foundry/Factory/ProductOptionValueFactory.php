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
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Product\Model\ProductOptionValue;
use Sylius\Component\Product\Model\ProductOptionValueInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ProductOptionValueInterface>
 *
 * @method        ProductOptionValueInterface|Proxy create(array|callable $attributes = [])
 * @method static ProductOptionValueInterface|Proxy createOne(array $attributes = [])
 * @method static ProductOptionValueInterface|Proxy find(object|array|mixed $criteria)
 * @method static ProductOptionValueInterface|Proxy findOrCreate(array $attributes)
 * @method static ProductOptionValueInterface|Proxy first(string $sortedField = 'id')
 * @method static ProductOptionValueInterface|Proxy last(string $sortedField = 'id')
 * @method static ProductOptionValueInterface|Proxy random(array $attributes = [])
 * @method static ProductOptionValueInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static ProductOptionValueInterface[]|Proxy[] all()
 * @method static ProductOptionValueInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProductOptionValueInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ProductOptionValueInterface[]|Proxy[] findBy(array $attributes)
 * @method static ProductOptionValueInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductOptionValueInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProductOptionValueFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;

    protected static function getClass(): string
    {
        return ProductOptionValue::class;
    }
}
