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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomCatalogPromotionsStory;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomCatalogPromotionsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_catalog_promotions(): void
    {
        self::bootKernel();

        LocaleFactory::new()->withCode('en_US')->create();
        RandomCatalogPromotionsStory::load();

        $catalogPromotions = $this->getCatalogPromotionRepository()->findAll();

        $this->assertCount(4, $catalogPromotions);
    }

    private function getCatalogPromotionRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.catalog_promotion');
    }
}
