<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\RandomAddressesFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\RandomCapsFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\RandomDressesFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\RandomJeansFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\RandomProductAssociationsFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\RandomProductReviewsFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\RandomShopUsersFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\RandomTShirtsFixtures;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.doctrine.fixtures.random_addresses', RandomAddressesFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.random_addresses'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_addresses'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.random_caps', RandomCapsFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.random_caps'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_products'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_caps'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.random_dresses', RandomDressesFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.random_dresses'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_products'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_dresses'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.random_jeans', RandomJeansFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.random_jeans'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_products'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_jeans'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.random_t_shirts', RandomTShirtsFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.random_t_shirts'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_products'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_t_shirts'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.random_shop_users', RandomShopUsersFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.random_shop_users'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_shop_users'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.random_product_reviews', RandomProductReviewsFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.random_product_reviews'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_product_reviews'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.random_product_associations', RandomProductAssociationsFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.random_product_associations'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'random_product_associations'])
    ;
};
