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

use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultAdminUsersFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultChannelsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultCurrenciesFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultCustomerGroupsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultGeographicalFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultLocalesFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultMenuTaxonFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultPaymentMethodsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultShippingMethodsFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultShopUsersFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultTaxCategoriesFixtures;
use Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures\DefaultTaxRatesFixtures;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_locales', DefaultLocalesFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_locales'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_locales'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_currencies', DefaultCurrenciesFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_currencies'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_currencies'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_geographical', DefaultGeographicalFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_geographical'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_geographical'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_customer_groups', DefaultCustomerGroupsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_customer_groups'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_customer_groups'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_menu_taxon', DefaultMenuTaxonFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_menu_taxon'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_menu_taxon'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_channels', DefaultChannelsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_channels'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_channels'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_shipping_methods', DefaultShippingMethodsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_shipping_methods'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_shipping_methods'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_payment_methods', DefaultPaymentMethodsFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_payment_methods'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_payment_methods'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_shop_users', DefaultShopUsersFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_shop_users'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_shop_users'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_admin_users', DefaultAdminUsersFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_admin_users'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_admin_users'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_tax_categories', DefaultTaxCategoriesFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_tax_categories'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_tax_categories'])

        ->set('sylius.fixtures_plugin.doctrine.fixtures.default_tax_rates', DefaultTaxRatesFixtures::class)
            ->args([
                service('sylius.fixtures_plugin.story.default_tax_rates'),
            ])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'sylius'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'shop_configuration'])
            ->tag(name: 'doctrine.fixture.orm', attributes: ['group' => 'default_tax_rates'])
    ;
};
