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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAssociationTypeFactory;
use Sylius\Component\Product\Model\ProductAssociationTypeInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ProductAssociationTypeFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_product_association_type_with_random_code(): void
    {
        $productAssociationType = ProductAssociationTypeFactory::createOne();

        $this->assertInstanceOf(ProductAssociationTypeInterface::class, $productAssociationType->object());
        $this->assertNotNull($productAssociationType->getCode());
    }

    /** @test */
    public function it_creates_product_association_type_with_given_code(): void
    {
        $productAssociationType = ProductAssociationTypeFactory::new()->withCode('expansion')->create();

        $this->assertEquals('expansion', $productAssociationType->getCode());
    }

    /** @test */
    public function it_creates_product_association_type_with_translations_on_each_locales(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        LocaleFactory::new()->withCode('fr_FR')->create();

        $productAssociationType = ProductAssociationTypeFactory::new()->create();

        $this->assertCount(2, $productAssociationType->getTranslations());
    }

    /** @test */
    public function it_creates_product_association_type_with_given_name_on_each_locales(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        LocaleFactory::new()->withCode('fr_FR')->create();

        $productAssociationType = ProductAssociationTypeFactory::new()->withName('Expansion')->create();

        // test en_US translation
        $productAssociationType->setCurrentLocale('en_US');
        $productAssociationType->setFallbackLocale('en_US');

        $this->assertEquals('Expansion', $productAssociationType->getName());

        // test fr_FR translation
        $productAssociationType->setCurrentLocale('fr_FR');
        $productAssociationType->setFallbackLocale('fr_FR');

        $this->assertEquals('Expansion', $productAssociationType->getName());
    }
}
