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

use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultAdminUsersFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultChannelsFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultCurrenciesFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultCustomerGroupsFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultGeographicalFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultLocalesFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultMenuTaxonFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultShippingMethodsFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultShopUsersFixtures;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixtures\DefaultTaxCategoriesFixtures;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.doctrine.fixtures.default_locales', DefaultLocalesFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_locales'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_currencies', DefaultCurrenciesFixtures::class)
            ->args([
                service('sylius.shop_fixtures.story.default_currencies'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_currencies'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_geographical', DefaultGeographicalFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_geographical'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_shipping_methods', DefaultShippingMethodsFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_shipping_methods'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_customer_groups', DefaultCustomerGroupsFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_customer_groups'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_menu_taxon', DefaultMenuTaxonFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_menu_taxon'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_channels', DefaultChannelsFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_channels'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_shop_users', DefaultShopUsersFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_shop_users'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_admin_users', DefaultAdminUsersFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_admin_users'])

        ->set('sylius.shop_fixtures.doctrine.fixtures.default_tax_categories', DefaultTaxCategoriesFixtures::class)
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_tax_categories'])
    ;
};
