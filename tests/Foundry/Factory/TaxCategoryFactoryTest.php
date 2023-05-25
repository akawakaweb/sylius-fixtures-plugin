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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxCategoryFactory;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class TaxCategoryFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_tax_category(): void
    {
        $taxCategory = TaxCategoryFactory::createOne();

        $this->assertInstanceOf(TaxCategoryInterface::class, $taxCategory->object());
        $this->assertNotNull($taxCategory->getCode());
        $this->assertNotNull($taxCategory->getName());
        //$this->assertNotNull($taxCategory->getDescription());
    }

    /** @test */
    public function it_creates_locales_with_given_code(): void
    {
        $taxCategory = TaxCategoryFactory::new()->withCode('TC1')->create();

        $this->assertEquals('TC1', $taxCategory->getCode());
    }

    /** @test */
    public function it_creates_locales_with_given_name(): void
    {
        $taxCategory = TaxCategoryFactory::new()->withName('Taxable goods')->create();

        $this->assertEquals('Taxable goods', $taxCategory->getName());
        $this->assertEquals('Taxable_goods', $taxCategory->getCode());
    }

    /** @test */
    public function it_creates_locales_with_given_description(): void
    {
        $taxCategory = TaxCategoryFactory::new()->withDescription('Taxable goods are evil.')->create();

        $this->assertEquals('Taxable goods are evil.', $taxCategory->getDescription());
    }
}
