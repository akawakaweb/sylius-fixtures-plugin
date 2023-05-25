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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAttributeFactory;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ProductAttributeFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_product_attribute(): void
    {
        $productAttribute = ProductAttributeFactory::createOne();

        $this->assertInstanceOf(ProductAttributeInterface::class, $productAttribute->object());
        $this->assertNotNull($productAttribute->getCode());
        //$this->assertTrue($productAttribute->isTranslatable());
        //$this->assertCount(1, $productAttribute->getTranslations());
        //$this->assertNotNull($productAttribute->getTranslation('en_US')->getName());
    }

    /** @test */
    public function it_creates_product_attribute_with_given_code(): void
    {
        $productAttribute = ProductAttributeFactory::new()->withCode('brand')->create();

        $this->assertEquals('brand', $productAttribute->getCode());
    }

    /** @test */
    public function it_creates_product_attribute_with_given_type(): void
    {
        $productAttribute = ProductAttributeFactory::new()->withType('textarea')->create();

        $this->assertEquals('textarea', $productAttribute->getType());
    }

    /** @test */
    public function it_creates_product_attribute_with_translations_for_each_locales(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        LocaleFactory::new()->withCode('fr_FR')->create();

        $productAttribute = ProductAttributeFactory::new()->create();

        $this->assertCount(2, $productAttribute->getTranslations());
    }

    /** @test */
    public function it_creates_product_attribute_with_given_name(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        LocaleFactory::new()->withCode('fr_FR')->create();

        $productAttribute = ProductAttributeFactory::new()->withName('Brand')->create();

        // test en_US translation
        $productAttribute->setCurrentLocale('en_US');
        $productAttribute->setFallbackLocale('en_US');
        $this->assertEquals('Brand', $productAttribute->getName());
        $this->assertEquals('Brand', $productAttribute->getCode());

        // test fr_FR translation
        $productAttribute->setCurrentLocale('fr_FR');
        $productAttribute->setFallbackLocale('fr_FR');
        $this->assertEquals('Brand', $productAttribute->getName());
        $this->assertEquals('Brand', $productAttribute->getCode());
    }

    /** @test */
    public function it_creates_translatable_product_attribute(): void
    {
        $productAttribute = ProductAttributeFactory::new()->translatable()->create();

        $this->assertTrue($productAttribute->isTranslatable());
    }

    /** @test */
    public function it_creates_untranslatable_product_attribute(): void
    {
        $productAttribute = ProductAttributeFactory::new()->untranslatable()->create();

        $this->assertFalse($productAttribute->isTranslatable());
    }

    /** @test */
    public function it_creates_product_attribute_with_given_configuration(): void
    {
        $productAttribute = ProductAttributeFactory::new()->withConfiguration(['foo' => 'fighters'])->create();

        $this->assertEquals(['foo' => 'fighters'], $productAttribute->getConfiguration());
    }
}
