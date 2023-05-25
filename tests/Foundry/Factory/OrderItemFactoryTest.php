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

namespace Tests\Akawakaweb\SyliusFixturesPlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\OrderFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\OrderItemFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductFactory;
use Sylius\Component\Core\Model\OrderItemInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
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
