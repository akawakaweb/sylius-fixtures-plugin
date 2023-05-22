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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CountryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\OrderFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductFactory;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class OrderFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_order_with_default_values(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        ChannelFactory::createOne();
        ProductFactory::new()->enabled()->many(5)->create();
        $order = OrderFactory::createOne();

        $this->assertInstanceOf(OrderInterface::class, $order->object());
        $this->assertNotNull($order->getChannel());
        $this->assertNotNull($order->getCurrencyCode());
        $this->assertNotNull($order->getLocaleCode());
    }

    /** @test */
    public function it_creates_order_with_given_channel_as_proxy(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $channel = ChannelFactory::createOne();
        $order = OrderFactory::new()->withChannel($channel)->create();

        $this->assertEquals($channel->object(), $order->getChannel());
    }

    /** @test */
    public function it_creates_order_with_given_channel(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $channel = ChannelFactory::createOne()->object();
        $order = OrderFactory::new()->withChannel($channel)->create();

        $this->assertEquals($channel, $order->getChannel());
    }

    /** @test */
    public function it_creates_order_with_given_channel_as_string(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $order = OrderFactory::new()->withChannel('default')->create();

        $this->assertEquals('default', $order->getChannel()->getCode());
    }

    /** @test */
    public function it_creates_order_with_given_customer_as_proxy(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $customer = CustomerFactory::createOne();
        $order = OrderFactory::new()->withCustomer($customer)->create();

        $this->assertEquals($customer->object(), $order->getCustomer());
    }

    /** @test */
    public function it_creates_order_with_given_customer(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $customer = CustomerFactory::createOne()->object();
        $order = OrderFactory::new()->withCustomer($customer)->create();

        $this->assertEquals($customer, $order->getCustomer());
    }

    /** @test */
    public function it_creates_order_with_given_customer_as_string(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $order = OrderFactory::new()->withCustomer('john.doe@example.com')->create();

        $this->assertEquals('john.doe@example.com', $order->getCustomer()->getEmail());
    }

    /** @test */
    public function it_creates_order_with_given_country_as_proxy(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $country = CountryFactory::new()->withCode('FR')->create();
        $order = OrderFactory::new()->withCountry($country)->create();

        $this->assertEquals('FR', $order->getBillingAddress()?->getCountryCode());
    }

    /** @test */
    public function it_creates_order_with_given_country(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $country = CountryFactory::new()->withCode('FR')->create()->object();
        $order = OrderFactory::new()->withCountry($country)->create();

        $this->assertEquals('FR', $order->getBillingAddress()?->getCountryCode());
    }

    /** @test */
    public function it_creates_order_with_given_country_as_string(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $order = OrderFactory::new()->withCountry('FR')->create();

        $this->assertEquals('FR', $order->getBillingAddress()?->getCountryCode());
    }
}
