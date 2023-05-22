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

use Sylius\Bundle\CoreBundle\Doctrine\ORM\OrderItemRepository;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItem;
use Sylius\Component\Core\Model\OrderItemInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<OrderItemInterface>
 *
 * @method        OrderItemInterface|Proxy create(array|callable $attributes = [])
 * @method static OrderItemInterface|Proxy createOne(array $attributes = [])
 * @method static OrderItemInterface|Proxy find(object|array|mixed $criteria)
 * @method static OrderItemInterface|Proxy findOrCreate(array $attributes)
 * @method static OrderItemInterface|Proxy first(string $sortedField = 'id')
 * @method static OrderItemInterface|Proxy last(string $sortedField = 'id')
 * @method static OrderItemInterface|Proxy random(array $attributes = [])
 * @method static OrderItemInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static OrderItemRepository|RepositoryProxy repository()
 * @method static OrderItemInterface[]|Proxy[] all()
 * @method static OrderItemInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static OrderItemInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static OrderItemInterface[]|Proxy[] findBy(array $attributes)
 * @method static OrderItemInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static OrderItemInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class OrderItemFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;

    public function withOrder(Proxy|OrderInterface $order): self
    {
        return $this->addState(['order' => $order]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? OrderItem::class;
    }
}
