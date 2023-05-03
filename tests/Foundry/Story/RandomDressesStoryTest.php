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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomDressesStory;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomDressesStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_dresses(): void
    {
        self::bootKernel();

        RandomDressesStory::load();

        $products = $this->getProductRepository()->findAll();

        $this->assertCount(3, $products);

        $product = $products[0];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Beige strappy summer dress', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('dresses', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('dress_01.jpg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[1];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Off shoulder boho dress', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('dresses', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('dress_02.jpg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[2];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Ruffle wrap festival dress', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('dresses', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('dress_03.jpg', $product->getImagesByType('main')[0]->getPath());
    }

    private function getProductRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product');
    }
}
