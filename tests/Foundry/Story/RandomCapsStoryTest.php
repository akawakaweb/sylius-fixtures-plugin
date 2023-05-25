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

namespace Tests\Akawakaweb\SyliusFixturesPlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomCapsStory;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomCapsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_caps(): void
    {
        self::bootKernel();

        LocaleFactory::new()->withCode('en_US')->create();
        RandomCapsStory::load();

        $products = $this->getProductRepository()->findAll();

        $this->assertCount(4, $products);

        $product = $products[0];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Knitted burgundy winter cap', $product->getName());
        $this->assertEquals('other', $product->getVariants()[0]->getTaxCategory()->getCode());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('caps_with_pompons', $product->getMainTaxon()->getCode());
        $this->assertEquals('caps', $product->getTaxons()->first()->getCode());
        $this->assertStringEndsWith('cap_01.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());

        $product = $products[1];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Knitted wool-blend green cap', $product->getName());
        $this->assertEquals('other', $product->getVariants()[0]->getTaxCategory()->getCode());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('simple_caps', $product->getMainTaxon()->getCode());
        $this->assertEquals('caps', $product->getTaxons()->first()->getCode());
        $this->assertStringEndsWith('cap_02.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());

        $product = $products[2];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Knitted white pompom cap', $product->getName());
        $this->assertEquals('other', $product->getVariants()[0]->getTaxCategory()->getCode());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('caps_with_pompons', $product->getMainTaxon()->getCode());
        $this->assertEquals('caps', $product->getTaxons()->first()->getCode());
        $this->assertStringEndsWith('cap_03.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());

        $product = $products[3];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Cashmere-blend violet beanie', $product->getName());
        $this->assertEquals('other', $product->getVariants()[0]->getTaxCategory()->getCode());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('simple_caps', $product->getMainTaxon()->getCode());
        $this->assertEquals('caps', $product->getTaxons()->first()->getCode());
        $this->assertStringEndsWith('cap_04.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());
    }

    private function getProductRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product');
    }
}
