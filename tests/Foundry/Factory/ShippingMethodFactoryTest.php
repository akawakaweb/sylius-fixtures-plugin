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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShippingCategoryFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShippingMethodFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxCategoryFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneFactory;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ShippingMethodFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_shipping_method(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        //ChannelFactory::createMany(3);
        $shippingMethod = ShippingMethodFactory::createOne();

        $this->assertInstanceOf(ShippingMethodInterface::class, $shippingMethod->object());
        $this->assertNotNull($shippingMethod->getCode());
        $this->assertNotNull($shippingMethod->getCalculator());
        $this->assertNotNull($shippingMethod->getZone());
        $this->assertNotNull($shippingMethod->getName());
        $this->assertNull($shippingMethod->getDescription());
        //$this->assertCount(3, $shippingMethod->getChannels());
        $this->assertSame('flat_rate', $shippingMethod->getCalculator());
        //$this->assertCount(3, $shippingMethod->getConfiguration());
        //$this->assertTrue($shippingMethod->isEnabled());
    }

    /** @test */
    public function it_creates_shipping_method_with_given_code(): void
    {
        $shippingMethod = ShippingMethodFactory::new()->withCode('SM2')->create();

        $this->assertEquals('SM2', $shippingMethod->getCode());
    }

    /** @test */
    public function it_creates_shipping_method_with_given_name(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $shippingMethod = ShippingMethodFactory::new()->withName('Shipping method 2')->create();

        $this->assertEquals('Shipping method 2', $shippingMethod->getName());
        $this->assertEquals('Shipping_method_2', $shippingMethod->getCode());
    }

    /** @test */
    public function it_creates_shipping_method_with_given_description(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $shippingMethod = ShippingMethodFactory::new()->withDescription('This is the Shipping method 2')->create();

        $this->assertEquals('This is the Shipping method 2', $shippingMethod->getDescription());
    }

    /** @test */
    public function it_creates_shipping_method_with_zone_as_proxy(): void
    {
        $zone = ZoneFactory::createOne();
        $shippingMethod = ShippingMethodFactory::new()->withZone($zone)->create();

        $this->assertEquals($zone->object(), $shippingMethod->getZone());
    }

    /** @test */
    public function it_creates_shipping_method_with_zone(): void
    {
        $zone = ZoneFactory::createOne()->object();
        $shippingMethod = ShippingMethodFactory::new()->withZone($zone)->create();

        $this->assertEquals($zone, $shippingMethod->getZone());
    }

    /** @test */
    public function it_creates_shipping_method_with_zone_as_string(): void
    {
        $shippingMethod = ShippingMethodFactory::new()->withZone('world')->create();

        $this->assertEquals('world', $shippingMethod->getZone()->getCode());
    }

    /** @test */
    public function it_creates_shipping_method_with_tax_category_as_proxy(): void
    {
        $taxCategory = TaxCategoryFactory::createOne();
        $shippingMethod = ShippingMethodFactory::new()->withTaxCategory($taxCategory)->create();

        $this->assertEquals($taxCategory->object(), $shippingMethod->getTaxCategory());
    }

    /** @test */
    public function it_creates_shipping_method_with_tax_category(): void
    {
        $taxCategory = TaxCategoryFactory::createOne()->object();
        $shippingMethod = ShippingMethodFactory::new()->withTaxCategory($taxCategory)->create();

        $this->assertEquals($taxCategory, $shippingMethod->getTaxCategory());
    }

    /** @test */
    public function it_creates_shipping_method_with_tax_category_as_string(): void
    {
        $shippingMethod = ShippingMethodFactory::new()->withTaxCategory('TC1')->create();

        $this->assertEquals('TC1', $shippingMethod->getTaxCategory()->getCode());
    }

    /** @test */
    public function it_creates_shipping_method_with_category_as_proxy(): void
    {
        $shippingCategory = ShippingCategoryFactory::createOne();
        $shippingMethod = ShippingMethodFactory::new()->withCategory($shippingCategory)->create();

        $this->assertEquals($shippingCategory->object(), $shippingMethod->getCategory());
    }

    /** @test */
    public function it_creates_shipping_method_with_category(): void
    {
        $shippingCategory = ShippingCategoryFactory::createOne()->object();
        $shippingMethod = ShippingMethodFactory::new()->withCategory($shippingCategory)->create();

        $this->assertEquals($shippingCategory, $shippingMethod->getCategory());
    }

    /** @test */
    public function it_creates_shipping_method_with_category_as_string(): void
    {
        $shippingMethod = ShippingMethodFactory::new()->withCategory('SC1')->create();

        $this->assertEquals('SC1', $shippingMethod->getCategory()->getCode());
    }

    /** @test */
    public function it_creates_shipping_method_with_given_channels_as_proxy(): void
    {
        $channel = ChannelFactory::createOne();
        $shippingMethod = ShippingMethodFactory::new()->withChannels([$channel])->create();

        $this->assertEquals($channel->object(), $shippingMethod->getChannels()->first());
    }

    /** @test */
    public function it_creates_shipping_method_with_given_channels(): void
    {
        $channel = ChannelFactory::createOne()->object();
        $shippingMethod = ShippingMethodFactory::new()->withChannels([$channel])->create();

        $this->assertEquals($channel, $shippingMethod->getChannels()->first());
    }

    /** @test */
    public function it_creates_shipping_method_with_given_channel_as_string(): void
    {
        $shippingMethod = ShippingMethodFactory::new()->withChannels(['default'])->create();

        $this->assertEquals('default', $shippingMethod->getChannels()->first()->getCode());
    }

    /** @test */
    public function it_creates_shipping_method_with_archive_date(): void
    {
        $archivedAt = new \DateTimeImmutable('today');
        $shippingMethod = ShippingMethodFactory::new()->withArchiveDate($archivedAt)->create();

        $this->assertEquals($archivedAt, $shippingMethod->getArchivedAt());
    }

    /** @test */
    public function it_creates_enabled_shipping_method(): void
    {
        $shippingMethod = ShippingMethodFactory::new()->enabled()->create();

        $this->assertTrue($shippingMethod->isEnabled());
    }

    /** @test */
    public function it_creates_disabled_shipping_method(): void
    {
        $shippingMethod = ShippingMethodFactory::new()->disabled()->create();

        $this->assertFalse($shippingMethod->isEnabled());
    }
}
