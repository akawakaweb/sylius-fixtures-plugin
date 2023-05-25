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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomDressesStory;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomDressesStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_dresses(): void
    {
        self::bootKernel();

        LocaleFactory::new()->withCode('en_US')->create();
        RandomDressesStory::load();

        $products = $this->getProductRepository()->findAll();

        $this->assertCount(3, $products);

        $product = $products[0];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Beige strappy summer dress', $product->getName());
        $this->assertEquals('clothing', $product->getVariants()[0]->getTaxCategory()->getCode());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('dresses', $product->getMainTaxon()->getCode());
        $this->assertEquals('dresses', $product->getTaxons()->first()->getCode());
        $this->assertStringEndsWith('dress_01.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());
        $this->assertCount(2, $product->getOptions());

        $product = $products[1];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Off shoulder boho dress', $product->getName());
        $this->assertEquals('clothing', $product->getVariants()[0]->getTaxCategory()->getCode());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('dresses', $product->getMainTaxon()->getCode());
        $this->assertEquals('dresses', $product->getTaxons()->first()->getCode());
        $this->assertStringEndsWith('dress_02.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());
        $this->assertCount(2, $product->getOptions());

        $product = $products[2];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Ruffle wrap festival dress', $product->getName());
        $this->assertEquals('clothing', $product->getVariants()[0]->getTaxCategory()->getCode());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('dresses', $product->getMainTaxon()->getCode());
        $this->assertEquals('dresses', $product->getTaxons()->first()->getCode());
        $this->assertStringEndsWith('dress_03.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(4, $product->getAttributes());
        $this->assertCount(2, $product->getOptions());
    }

    private function getProductRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product');
    }
}
