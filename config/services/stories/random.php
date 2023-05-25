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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomAddressesStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomAddressesStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomCapsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomCapsStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomCatalogPromotionsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomCatalogPromotionsStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomDressesStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomDressesStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomJeansStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomJeansStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomOrdersStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomOrdersStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomProductAssociationsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomProductAssociationsStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomProductReviewsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomProductReviewsStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomPromotionsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomShopUsersStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomShopUsersStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomTShirtsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomTShirtsStoryInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.fixtures_plugin.story.random_addresses', RandomAddressesStory::class)
            ->tag('foundry.story')
        ->alias(RandomAddressesStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_addresses')

        ->set('sylius.fixtures_plugin.story.random_caps', RandomCapsStory::class)
            ->tag('foundry.story')
        ->alias(RandomCapsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_caps')

        ->set('sylius.fixtures_plugin.story.random_dresses', RandomDressesStory::class)
            ->tag('foundry.story')
        ->alias(RandomDressesStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_dresses')

        ->set('sylius.fixtures_plugin.story.random_jeans', RandomJeansStory::class)
            ->tag('foundry.story')
        ->alias(RandomJeansStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_jeans')

        ->set('sylius.fixtures_plugin.story.random_t_shirts', RandomTShirtsStory::class)
            ->tag('foundry.story')
        ->alias(RandomTShirtsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_t_shirts')

        ->set('sylius.fixtures_plugin.story.random_orders', RandomOrdersStory::class)
            ->tag('foundry.story')
        ->alias(RandomOrdersStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_orders')

        ->set('sylius.fixtures_plugin.story.random_shop_users', RandomShopUsersStory::class)
            ->tag('foundry.story')
        ->alias(RandomShopUsersStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_shop_users')

        ->set('sylius.fixtures_plugin.story.random_product_reviews', RandomProductReviewsStory::class)
            ->tag('foundry.story')
        ->alias(RandomProductReviewsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_product_reviews')

        ->set('sylius.fixtures_plugin.story.random_product_associations', RandomProductAssociationsStory::class)
            ->tag('foundry.story')
        ->alias(RandomProductAssociationsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_product_associations')

        ->set('sylius.fixtures_plugin.story.random_catalog_promotions', RandomCatalogPromotionsStory::class)
            ->tag('foundry.story')
        ->alias(RandomCatalogPromotionsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_catalog_promotions')

        ->set('sylius.fixtures_plugin.story.random_promotions', RandomPromotionsStory::class)
            ->tag('foundry.story')
        ->alias(RandomCatalogPromotionsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.random_promotions')
    ;
};
