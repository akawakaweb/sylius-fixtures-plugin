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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductOptionFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductOptionValueFactory;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Sylius\Component\Product\Model\ProductOptionValueInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ProductOptionFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_product_option_with_random_data(): void
    {
        $productOption = ProductOptionFactory::createOne();

        $this->assertInstanceOf(ProductOptionInterface::class, $productOption->object());
        $this->assertNotNull($productOption->getCode());
    }

    /** @test */
    public function it_creates_product_option_with_given_code(): void
    {
        $productOption = ProductOptionFactory::new()->withCode('007')->create();

        $this->assertEquals('007', $productOption->getCode());
    }

    /** @test */
    public function it_creates_product_option_with_given_values_as_proxies(): void
    {
        LocaleFactory::createOne();

        $blueValue = ProductOptionValueFactory::new()->withCode('blue')->create();

        $productOption = ProductOptionFactory::new()->withValues([$blueValue])->create();

        $this->assertCount(1, $productOption->getValues());

        /** @var ProductOptionValueInterface $blue */
        $blue = $productOption->getValues()->first();
        $this->assertEquals('blue', $blue->getCode());
    }

    /** @test */
    public function it_creates_product_option_with_given_values(): void
    {
        LocaleFactory::createOne();

        $productOption = ProductOptionFactory::new()->withValues([
            'blue' => 'Blue',
            'green' => 'Green',
            'red' => 'Red',
        ])->create();

        $this->assertCount(3, $productOption->getValues());

        /** @var ProductOptionValueInterface $blue */
        $blue = $productOption->getValues()->first();
        $this->assertEquals('blue', $blue->getCode());
        $this->assertEquals('Blue', $blue->getValue());
    }
}
