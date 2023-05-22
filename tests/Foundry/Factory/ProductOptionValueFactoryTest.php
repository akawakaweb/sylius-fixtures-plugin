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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductOptionValueFactory;
use Sylius\Component\Product\Model\ProductOptionValueInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ProductOptionValueFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_product_option_value_with_random_data(): void
    {
        $productOptionValue = ProductOptionValueFactory::createOne();

        $this->assertInstanceOf(ProductOptionValueInterface::class, $productOptionValue->object());
        $this->assertNotNull($productOptionValue->getCode());
    }

    /** @test */
    public function it_creates_product_option_value_with_given_code(): void
    {
        $productOptionValue = ProductOptionValueFactory::new()->withCode('blue')->create();

        $this->assertEquals('blue', $productOptionValue->getCode());
    }

    /** @test */
    public function it_creates_product_option_value_with_given_value(): void
    {
        LocaleFactory::createOne();
        $productOptionValue = ProductOptionValueFactory::new()->withValue('Blue')->create();

        $this->assertEquals('Blue', $productOptionValue->getValue());
    }
}
