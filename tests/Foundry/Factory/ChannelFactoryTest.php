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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShopBillingDataFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxonFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneFactory;
use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ChannelFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_channel_with_default_values(): void
    {
        $channel = ChannelFactory::createOne();

        $this->assertInstanceOf(ChannelInterface::class, $channel->object());
        $this->assertNotNull($channel->getCode());
        $this->assertNotNull($channel->getName());
        //$this->assertNotNull($channel->getColor());
        $this->assertIsBool($channel->isEnabled());
        //$this->assertFalse($channel->isSkippingShippingStepAllowed());
        //$this->assertFalse($channel->isSkippingPaymentStepAllowed());
        //$this->assertTrue($channel->isAccountVerificationRequired());
        //$this->assertNotNull($channel->getDefaultTaxZone());
        $this->assertEquals('order_items_based', $channel->getTaxCalculationStrategy());
        $this->assertNotNull($channel->getDefaultLocale());
        $this->assertNotNull($channel->getBaseCurrency());
        $this->assertNull($channel->getThemeName());
        $this->assertNull($channel->getContactEmail());
        $this->assertNull($channel->getContactPhoneNumber());
        $this->assertNull($channel->getShopBillingData());
        $this->assertNull($channel->getMenuTaxon());
    }

    /** @test */
    public function it_creates_channel_with_given_code(): void
    {
        $channel = ChannelFactory::new()->withCode('default_channel')->create();

        $this->assertEquals('default_channel', $channel->getCode());
        //$this->assertEquals('default_channel.localhost', $channel->getHostname());
    }

    /** @test */
    public function it_creates_channel_with_given_name(): void
    {
        $channel = ChannelFactory::new()->withName('Default channel')->create();

        $this->assertEquals('Default channel', $channel->getName());
        //$this->assertEquals('Default_channel', $channel->getCode());
    }

    /** @test */
    public function it_creates_channel_with_given_hostname(): void
    {
        $channel = ChannelFactory::new()->withHostname('default.localhost')->create();

        $this->assertEquals('default.localhost', $channel->getHostname());
    }

    /** @test */
    public function it_creates_channel_with_given_color(): void
    {
        $channel = ChannelFactory::new()->withColor('#1abb9c')->create();

        $this->assertEquals('#1abb9c', $channel->getColor());
    }

    /** @test */
    public function it_creates_enabled_channel(): void
    {
        $channel = ChannelFactory::new()->enabled()->create();

        $this->assertTrue($channel->isEnabled());
    }

    /** @test */
    public function it_creates_disabled_channel(): void
    {
        $channel = ChannelFactory::new()->disabled()->create();

        $this->assertFalse($channel->isEnabled());
    }

    /** @test */
    public function it_creates_channel_with_skipping_shipping_step_allowed(): void
    {
        $channel = ChannelFactory::new()->withSkippingShippingStepAllowed()->create();

        $this->assertTrue($channel->isSkippingShippingStepAllowed());
    }

    /** @test */
    public function it_creates_channel_with_skipping_payment_step_allowed(): void
    {
        $channel = ChannelFactory::new()->withSkippingPaymentStepAllowed()->create();

        $this->assertTrue($channel->isSkippingPaymentStepAllowed());
    }

    /** @test */
    public function it_creates_channel_without_account_verification_required(): void
    {
        $channel = ChannelFactory::new()->withoutAccountVerificationRequired()->create();

        $this->assertFalse($channel->isAccountVerificationRequired());
    }

    /** @test */
    public function it_creates_channel_with_given_already_existing_proxy_default_tax_zone(): void
    {
        $zone = ZoneFactory::new()->withCode('world')->create();

        $channel = ChannelFactory::new()->withDefaultTaxZone($zone)->create();

        $this->assertEquals('world', $channel->getDefaultTaxZone()->getCode());
    }

    /** @test */
    public function it_creates_channel_with_given_already_existing_default_tax_zone(): void
    {
        $zone = ZoneFactory::new()->withCode('world')->create()->object();

        $channel = ChannelFactory::new()->withDefaultTaxZone($zone)->create();

        $this->assertEquals('world', $channel->getDefaultTaxZone()->getCode());
    }

    /** @test */
    public function it_creates_channel_with_given_already_existing_default_tax_zone_code(): void
    {
        ZoneFactory::new()->withCode('world')->create();

        $channel = ChannelFactory::new()->withDefaultTaxZone('world')->create();

        $this->assertEquals('world', $channel->getDefaultTaxZone()->getCode());
    }

    /** @test */
    public function it_creates_channel_with_given_tax_calculation_strategy(): void
    {
        $channel = ChannelFactory::new()->withTaxCalculationStrategy('order_based')->create();

        $this->assertEquals('order_based', $channel->getTaxCalculationStrategy());
    }

    /** @test */
    public function it_creates_channel_with_given_theme_name(): void
    {
        $channel = ChannelFactory::new()->withThemeName('custom_theme')->create();

        $this->assertEquals('custom_theme', $channel->getThemeName());
    }

    /** @test */
    public function it_creates_channel_with_given_contact_email(): void
    {
        $channel = ChannelFactory::new()->withContactEmail('darthvader@starwars.com')->create();

        $this->assertEquals('darthvader@starwars.com', $channel->getContactEmail());
    }

    /** @test */
    public function it_creates_channel_with_given_contact_phone_number(): void
    {
        $channel = ChannelFactory::new()->withContactPhoneNumber('0666-0666')->create();

        $this->assertEquals('0666-0666', $channel->getContactPhoneNumber());
    }

    /** @test */
    public function it_creates_channel_with_given_array_of_shop_billing_data(): void
    {
        $channel = ChannelFactory::new()->withShopBillingData(['company' => 'Sylius'])->create();

        $this->assertEquals('Sylius', $channel->getShopBillingData()->getCompany());
    }

    /** @test */
    public function it_creates_channel_with_given_proxy_shop_billing_data(): void
    {
        $shopBillingData = ShopBillingDataFactory::new()->withCompany('Sylius')->create();

        $channel = ChannelFactory::new()->withShopBillingData($shopBillingData)->create();

        $this->assertEquals('Sylius', $channel->getShopBillingData()->getCompany());
    }

    /** @test */
    public function it_creates_channel_with_given_shop_billing_data(): void
    {
        $shopBillingData = ShopBillingDataFactory::new()->withCompany('Sylius')->create()->object();

        $channel = ChannelFactory::new()->withShopBillingData($shopBillingData)->create();

        $this->assertEquals('Sylius', $channel->getShopBillingData()->getCompany());
    }

    /** @test */
    public function it_creates_channel_with_given_proxy_locales(): void
    {
        $locale = LocaleFactory::createOne();
        $channel = ChannelFactory::new()->withLocales([$locale])->create();

        $this->assertEquals($locale->object(), $channel->getLocales()->first());
    }

    /** @test */
    public function it_creates_channel_with_given_locales_as_string(): void
    {
        $channel = ChannelFactory::new()->withLocales(['fr_FR'])->create();

        // a default locale has been created first, so it is the last one or the only one
        $this->assertEquals('fr_FR', $channel->getLocales()->first()->getCode());
    }

    /** @test */
    public function it_creates_channel_with_given_proxy_currencies(): void
    {
        $currency = CurrencyFactory::createOne();
        $channel = ChannelFactory::new()->withCurrencies([$currency])->create();

        $this->assertEquals($currency->object(), $channel->getCurrencies()->first());
    }

    /** @test */
    public function it_creates_channel_with_given_currencies_as_string(): void
    {
        $channel = ChannelFactory::new()->withCurrencies(['USD'])->create();

        $this->assertEquals('USD', $channel->getCurrencies()->first()->getCode());
    }

    /** @test */
    public function it_creates_channel_with_given_proxy_menu_taxon(): void
    {
        $taxon = TaxonFactory::createOne();
        $channel = ChannelFactory::new()->withMenuTaxon($taxon)->create();

        $this->assertEquals($taxon->object(), $channel->getMenuTaxon());
    }

    /** @test */
    public function it_creates_channel_with_given_menu_taxon(): void
    {
        $taxon = TaxonFactory::createOne()->object();
        $channel = ChannelFactory::new()->withMenuTaxon($taxon)->create();

        $this->assertEquals($taxon, $channel->getMenuTaxon());
    }

    /** @test */
    public function it_creates_channel_with_given_menu_taxon_as_string(): void
    {
        $channel = ChannelFactory::new()->withMenuTaxon('MENU_CATEGORY')->create();

        $this->assertEquals('MENU_CATEGORY', $channel->getMenuTaxon()->getCode());
    }
}
