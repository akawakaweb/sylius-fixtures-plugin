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

use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomAddressesFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomCapsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomCatalogPromotionsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomDressesFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomJeansFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomOrdersFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomProductAssociationsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomProductReviewsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomPromotionsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomShopUsersFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\RandomTShirtsFixtures;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_addresses', RandomAddressesFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_addresses'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_addresses'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_caps', RandomCapsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_caps'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_products'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_caps'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_dresses', RandomDressesFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_dresses'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_products'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_dresses'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_jeans', RandomJeansFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_jeans'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_products'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_jeans'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_t_shirts', RandomTShirtsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_t_shirts'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_products'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_t_shirts'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_shop_users', RandomShopUsersFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_shop_users'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_shop_users'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_product_reviews', RandomProductReviewsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_product_reviews'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_product_reviews'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_product_associations', RandomProductAssociationsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_product_associations'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_product_associations'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_catalog_promotions', RandomCatalogPromotionsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_catalog_promotions'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_catalog_promotions'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_promotions', RandomPromotionsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_promotions'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_promotions'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.random_orders', RandomOrdersFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.random_orders'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_orders'])
    ;
};
