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

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultAdminUsersStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultCurrenciesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultCustomerGroupsStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultGeographicalStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultLocalesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultMenuTaxonStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultShopUsersStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultTaxCategoriesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomAddressesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomCapsStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomDressesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomJeansStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomShopUsersStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomTShirtsStory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.story.default_admin_users', DefaultAdminUsersStory::class)
            ->tag('foundry.story')
        ->alias(DefaultAdminUsersStory::class, 'sylius.shop_fixtures.foundry.story.default_admin_users')

        ->set('sylius.shop_fixtures.story.default_currencies', DefaultCurrenciesStory::class)
            ->tag('foundry.story')
        ->alias(DefaultCurrenciesStory::class, 'sylius.shop_fixtures.foundry.story.default_currencies')

        ->set('sylius.shop_fixtures.story.default_customer_groups', DefaultCustomerGroupsStory::class)
            ->tag('foundry.story')
        ->alias(DefaultCustomerGroupsStory::class, 'sylius.shop_fixtures.foundry.story.default_customer_groups')

        ->set('sylius.shop_fixtures.story.default_geographical', DefaultGeographicalStory::class)
            ->tag('foundry.story')
        ->alias(DefaultGeographicalStory::class, 'sylius.shop_fixtures.foundry.story.default_geographical')

        ->set('sylius.shop_fixtures.story.default_locales', DefaultLocalesStory::class)
            ->tag('foundry.story')
        ->alias(DefaultLocalesStory::class, 'sylius.shop_fixtures.foundry.story.default_locales')

        ->set('sylius.shop_fixtures.story.default_shop_users', DefaultShopUsersStory::class)
            ->tag('foundry.story')
        ->alias(DefaultShopUsersStory::class, 'sylius.shop_fixtures.foundry.story.default_shop_users')

        ->set('sylius.shop_fixtures.story.default_menu_taxon', DefaultMenuTaxonStory::class)
            ->tag('foundry.story')
        ->alias(DefaultMenuTaxonStory::class, 'sylius.shop_fixtures.foundry.story.default_menu_taxon')

        ->set('sylius.shop_fixtures.story.default_tax_category', DefaultTaxCategoriesStory::class)
            ->tag('foundry.story')
        ->alias(DefaultTaxCategoriesStory::class, 'sylius.shop_fixtures.foundry.story.default_tax_category')

        ->set('sylius.shop_fixtures.story.random_addresses', RandomAddressesStory::class)
            ->tag('foundry.story')
        ->alias(RandomAddressesStory::class, 'sylius.shop_fixtures.foundry.story.random_addresses')

        ->set('sylius.shop_fixtures.story.random_caps', RandomCapsStory::class)
            ->tag('foundry.story')
        ->alias(RandomCapsStory::class, 'sylius.shop_fixtures.foundry.story.random_caps')

        ->set('sylius.shop_fixtures.story.random_dresses', RandomDressesStory::class)
            ->tag('foundry.story')
        ->alias(RandomDressesStory::class, 'sylius.shop_fixtures.foundry.story.random_dresses')

        ->set('sylius.shop_fixtures.story.random_jeans', RandomJeansStory::class)
            ->tag('foundry.story')
        ->alias(RandomJeansStory::class, 'sylius.shop_fixtures.foundry.story.random_jeans')

        ->set('sylius.shop_fixtures.story.random_t_shirts', RandomTShirtsStory::class)
            ->tag('foundry.story')
        ->alias(RandomTShirtsStory::class, 'sylius.shop_fixtures.foundry.story.random_t_shirts')

        ->set('sylius.shop_fixtures.story.random_shop_users', RandomShopUsersStory::class)
            ->tag('foundry.story')
        ->alias(RandomShopUsersStory::class, 'sylius.shop_fixtures.foundry.story.random_shop_users')
    ;
};
