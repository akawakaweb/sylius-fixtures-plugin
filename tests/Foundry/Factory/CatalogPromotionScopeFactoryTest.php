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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CatalogPromotionScopeFactory;
use Sylius\Bundle\CoreBundle\CatalogPromotion\Checker\InForTaxonsScopeVariantChecker;
use Sylius\Component\Core\Model\CatalogPromotionScopeInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class CatalogPromotionScopeFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_catalog_promotion_scope(): void
    {
        $catalogPromotionScope = CatalogPromotionScopeFactory::createOne();

        $this->assertInstanceOf(CatalogPromotionScopeInterface::class, $catalogPromotionScope->object());
        $this->assertEquals('for_products', $catalogPromotionScope->getType());
        $this->assertEquals([], $catalogPromotionScope->getConfiguration());
    }

    /** @test */
    public function it_creates_catalog_promotion_scope_with_given_type(): void
    {
        $catalogPromotionScope = CatalogPromotionScopeFactory::new()->withType(InForTaxonsScopeVariantChecker::TYPE)->create();

        $this->assertEquals(InForTaxonsScopeVariantChecker::TYPE, $catalogPromotionScope->getType());
    }

    /** @test */
    public function it_creates_catalog_promotion_scope_with_given_configuration(): void
    {
        $country = CatalogPromotionScopeFactory::new()->withConfiguration(['foo' => 'fighters'])->create();

        $this->assertEquals(['foo' => 'fighters'], $country->getConfiguration());
    }
}
