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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\OrderFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\OrderItemFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductFactory;
use Sylius\Component\Core\Model\OrderItemInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class OrderItemFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_order_item_with_default_values(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        ChannelFactory::createOne();
        ProductFactory::new()->enabled()->many(5)->create();

        $orderItem = OrderItemFactory::createOne();

        $this->assertInstanceOf(OrderItemInterface::class, $orderItem->object());
        $this->assertNotNull($orderItem->getOrder());
        $this->assertNotNull($orderItem->getQuantity());
        $this->assertNotNull($orderItem->getVariant());
        $this->assertNotNull($orderItem->getTotal());
    }

    /** @test */
    public function it_creates_order_item_with_given_order(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        ChannelFactory::createOne();
        ProductFactory::new()->enabled()->many(5)->create();
        $order = OrderFactory::createOne();

        $orderItem = OrderItemFactory::new()->withOrder($order)->create();

        $this->assertInstanceOf(OrderItemInterface::class, $orderItem->object());
        $this->assertEquals($order->getId(), $orderItem->getOrder()->getId());
    }
}
