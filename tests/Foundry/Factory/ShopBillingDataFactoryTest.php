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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShopBillingDataFactory;
use Sylius\Component\Core\Model\ShopBillingDataInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ShopBillingDataFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_shop_billing_data_with_minimal_data(): void
    {
        $shopBillingData = ShopBillingDataFactory::createOne();

        $this->assertInstanceOf(ShopBillingDataInterface::class, $shopBillingData->object());
        $this->assertNull($shopBillingData->getCompany());
        $this->assertNull($shopBillingData->getCountryCode());
        $this->assertNull($shopBillingData->getStreet());
        $this->assertNull($shopBillingData->getCity());
        $this->assertNull($shopBillingData->getPostcode());
    }

    /** @test */
    public function it_creates_channel_with_given_company(): void
    {
        $shopBillingData = ShopBillingDataFactory::new()->withCompany('Sylius')->create();

        $this->assertEquals('Sylius', $shopBillingData->getCompany());
    }

    /** @test */
    public function it_creates_channel_with_given_tax_id(): void
    {
        $shopBillingData = ShopBillingDataFactory::new()->withTaxId('1100110011')->create();

        $this->assertEquals('1100110011', $shopBillingData->getTaxId());
    }

    /** @test */
    public function it_creates_channel_with_given_country_code(): void
    {
        $shopBillingData = ShopBillingDataFactory::new()->withCountryCode('FR')->create();

        $this->assertEquals('FR', $shopBillingData->getCountryCode());
    }

    /** @test */
    public function it_creates_channel_with_given_street(): void
    {
        $shopBillingData = ShopBillingDataFactory::new()->withStreet('Blue Street')->create();

        $this->assertEquals('Blue Street', $shopBillingData->getStreet());
    }

    /** @test */
    public function it_creates_channel_with_given_city(): void
    {
        $shopBillingData = ShopBillingDataFactory::new()->withCity('New York')->create();

        $this->assertEquals('New York', $shopBillingData->getCity());
    }

    /** @test */
    public function it_creates_channel_with_given_postcode(): void
    {
        $shopBillingData = ShopBillingDataFactory::new()->withPostcode('94111')->create();

        $this->assertEquals('94111', $shopBillingData->getPostcode());
    }
}
