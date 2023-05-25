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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShippingCategoryFactory;
use Sylius\Component\Shipping\Model\ShippingCategoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ShippingCategoryFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_shipping_category(): void
    {
        $shippingCategory = ShippingCategoryFactory::createOne();

        $this->assertInstanceOf(ShippingCategoryInterface::class, $shippingCategory->object());
        $this->assertNotNull($shippingCategory->getCode());
    }

    /** @test */
    public function it_creates_shipping_category_with_given_code(): void
    {
        $shippingCategory = ShippingCategoryFactory::new()->withCode('SC2')->create();

        $this->assertEquals('SC2', $shippingCategory->getCode());
    }

    /** @test */
    public function it_creates_shipping_category_with_given_name(): void
    {
        $shippingCategory = ShippingCategoryFactory::new()->withName('Shipping category one')->create();

        $this->assertEquals('Shipping category one', $shippingCategory->getName());
        $this->assertEquals('Shipping_category_one', $shippingCategory->getCode());
    }

    /** @test */
    public function it_creates_shipping_category_with_given_description(): void
    {
        $shippingCategory = ShippingCategoryFactory::new()->withDescription('One category to rule them all.')->create();

        $this->assertEquals('One category to rule them all.', $shippingCategory->getDescription());
    }
}
