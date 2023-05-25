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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxCategoryFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxRateFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneFactory;
use Sylius\Component\Core\Model\TaxRateInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class TaxRateFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_tax_rate_with_default_values(): void
    {
        $taxRate = TaxRateFactory::new()->create();

        $this->assertInstanceOf(TaxRateInterface::class, $taxRate->object());
        $this->assertNotNull($taxRate->getCode());
        $this->assertNotNull($taxRate->getName());
        $this->assertNotNull($taxRate->getAmount());
        $this->assertEquals('default', $taxRate->getCalculator());
        $this->assertNotNull($taxRate->getZone());
        $this->assertNotNull($taxRate->getCategory());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_code(): void
    {
        $taxRate = TaxRateFactory::new()->withCode('TR1')->create();

        $this->assertEquals('TR1', $taxRate->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_name(): void
    {
        $taxRate = TaxRateFactory::new()->withName('Tax rate 1')->create();

        $this->assertEquals('Tax rate 1', $taxRate->getName());
        $this->assertEquals('Tax_rate_1', $taxRate->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_amount(): void
    {
        $taxRate = TaxRateFactory::new()->withAmount(0.42)->create();

        $this->assertEquals(0.42, $taxRate->getAmount());
    }

    /** @test */
    public function it_creates_included_in_price_tax_rate(): void
    {
        $taxRate = TaxRateFactory::new()->includedInPrice()->create();

        $this->assertEquals(true, $taxRate->isIncludedInPrice());
    }

    /** @test */
    public function it_creates_not_included_in_price_tax_rate(): void
    {
        $taxRate = TaxRateFactory::new()->notIncludedInPrice()->create();

        $this->assertEquals(false, $taxRate->isIncludedInPrice());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_calculator(): void
    {
        $taxRate = TaxRateFactory::new()->withCalculator('custom_calculator')->create();

        $this->assertEquals('custom_calculator', $taxRate->getCalculator());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_proxy_zone(): void
    {
        $zone = ZoneFactory::new()->withCode('world')->create();

        $taxRate = TaxRateFactory::new()->withZone($zone)->create();

        $this->assertEquals('world', $taxRate->getZone()->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_zone(): void
    {
        $zone = ZoneFactory::new()->withCode('world')->create()->object();

        $taxRate = TaxRateFactory::new()->withZone($zone)->create();

        $this->assertEquals('world', $taxRate->getZone()->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_existing_zone_code(): void
    {
        ZoneFactory::new()->withCode('world')->create();

        $taxRate = TaxRateFactory::new()->withZone('world')->create();

        $this->assertEquals('world', $taxRate->getZone()->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_new_zone_code(): void
    {
        $taxRate = TaxRateFactory::new()->withZone('world')->create();

        $this->assertEquals('world', $taxRate->getZone()->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_proxy_category(): void
    {
        $taxCategory = TaxCategoryFactory::new()->withCode('TC1')->create();

        $taxRate = TaxRateFactory::new()->withCategory($taxCategory)->create();

        $this->assertEquals('TC1', $taxRate->getCategory()->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_category(): void
    {
        $taxCategory = TaxCategoryFactory::new()->withCode('TC1')->create()->object();

        $taxRate = TaxRateFactory::new()->withCategory($taxCategory)->create();

        $this->assertEquals('TC1', $taxRate->getCategory()->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_existing_category_code(): void
    {
        TaxCategoryFactory::new()->withCode('TC1')->create();

        $taxRate = TaxRateFactory::new()->withCategory('TC1')->create();

        $this->assertEquals('TC1', $taxRate->getCategory()->getCode());
    }

    /** @test */
    public function it_creates_tax_rate_with_given_new_category_code(): void
    {
        $taxRate = TaxRateFactory::new()->withCategory('TC1')->create();

        $this->assertEquals('TC1', $taxRate->getCategory()->getCode());
    }
}
