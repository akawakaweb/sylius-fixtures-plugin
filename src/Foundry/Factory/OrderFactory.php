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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithChannelTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCountryTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCustomerTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\OrderRepository;
use Sylius\Component\Core\Model\Order;
use Sylius\Component\Core\Model\OrderInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<OrderInterface>
 *
 * @method        OrderInterface|Proxy create(array|callable $attributes = [])
 * @method static OrderInterface|Proxy createOne(array $attributes = [])
 * @method static OrderInterface|Proxy find(object|array|mixed $criteria)
 * @method static OrderInterface|Proxy findOrCreate(array $attributes)
 * @method static OrderInterface|Proxy first(string $sortedField = 'id')
 * @method static OrderInterface|Proxy last(string $sortedField = 'id')
 * @method static OrderInterface|Proxy random(array $attributes = [])
 * @method static OrderInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static OrderRepository|RepositoryProxy repository()
 * @method static OrderInterface[]|Proxy[] all()
 * @method static OrderInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static OrderInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static OrderInterface[]|Proxy[] findBy(array $attributes)
 * @method static OrderInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static OrderInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class OrderFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithChannelTrait;
    use WithCustomerTrait;
    use WithCountryTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? Order::class;
    }
}
