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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomProductAssociationsStory;
use Sylius\Component\Product\Model\ProductAssociationTypeInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomProductAssociationsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_product_associations(): void
    {
        self::bootKernel();

        LocaleFactory::new()->withCode('en_US')->create();
        RandomProductAssociationsStory::load();

        $productAssociations = $this->getProductAssociationRepository()->findAll();
        $productAssociationTypes = $this->getProductAssociationTypeRepository()->findAll();
        $products = $this->getProductRepository()->findAll();

        $this->assertCount(3, $productAssociations);
        $this->assertCount(1, $productAssociationTypes);
        $this->assertCount(3, $products);

        /** @var ProductAssociationTypeInterface $productAssociationType */
        $productAssociationType = $productAssociationTypes[0];
        $this->assertInstanceOf(ProductAssociationTypeInterface::class, $productAssociationType);
        $this->assertEquals('similar_products', $productAssociationType->getCode());
        $this->assertEquals('Similar products', $productAssociationType->getName());
    }

    private function getProductRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product');
    }

    private function getProductAssociationRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product_association');
    }

    private function getProductAssociationTypeRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product_association_type');
    }
}
