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

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomJeansStory;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomJeansStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_jeans(): void
    {
        self::bootKernel();

        RandomJeansStory::load();

        $products = $this->getProductRepository()->findAll();

        $this->assertCount(8, $products);

        $product = $products[0];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('911M regular fit jeans', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('mens_jeans', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('jeans_01.jpg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[1];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('330M slim fit jeans', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('mens_jeans', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('jeans_02.jpg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[2];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('990M regular fit jeans', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('mens_jeans', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('jeans_03.jpg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[3];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('007M black elegance jeans', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('mens_jeans', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('jeans_04.svg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[4];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('727F patched cropped jeans', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('women_jeans', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('jeans_01.jpg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[5];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('111F patched jeans with fancy badges', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('women_jeans', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('jeans_02.jpg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[6];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('000F office grey jeans', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('women_jeans', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('jeans_03.jpg', $product->getImagesByType('main')[0]->getPath());

        $product = $products[7];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('666F boyfriend jeans with rips', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('women_jeans', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('jeans_04.jpg', $product->getImagesByType('main')[0]->getPath());
    }

    private function getProductRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product');
    }
}
