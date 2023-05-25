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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultAdminUsersStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultAdminUsersStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultChannelsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultChannelsStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultCurrenciesStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultCurrenciesStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultCustomerGroupsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultCustomerGroupsStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultGeographicalStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultGeographicalStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultLocalesStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultLocalesStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultMenuTaxonStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultMenuTaxonStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultPaymentMethodsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultPaymentMethodsStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultShippingMethodsStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultShippingMethodsStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultShopUsersStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultShopUsersStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultTaxCategoriesStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultTaxCategoriesStoryInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultTaxRatesStory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultTaxRatesStoryInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.fixtures_plugin.story.default_admin_users', DefaultAdminUsersStory::class)
            ->tag('foundry.story')
        ->alias(DefaultAdminUsersStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_admin_users')

        ->set('sylius.fixtures_plugin.story.default_channels', DefaultChannelsStory::class)
            ->args([
                param('sylius_locale.locale'),
                param('env(resolve:SYLIUS_FIXTURES_HOSTNAME)'),
                param('env(resolve:SYLIUS_FIXTURES_THEME_NAME)'),
            ])
            ->tag('foundry.story')
        ->alias(DefaultChannelsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_channels')

        ->set('sylius.fixtures_plugin.story.default_currencies', DefaultCurrenciesStory::class)
            ->tag('foundry.story')
        ->alias(DefaultCurrenciesStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_currencies')

        ->set('sylius.fixtures_plugin.story.default_customer_groups', DefaultCustomerGroupsStory::class)
            ->tag('foundry.story')
        ->alias(DefaultCustomerGroupsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_customer_groups')

        ->set('sylius.fixtures_plugin.story.default_geographical', DefaultGeographicalStory::class)
            ->tag('foundry.story')
        ->alias(DefaultGeographicalStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_geographical')

        ->set('sylius.fixtures_plugin.story.default_locales', DefaultLocalesStory::class)
            ->tag('foundry.story')
        ->alias(DefaultLocalesStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_locales')

        ->set('sylius.fixtures_plugin.story.default_menu_taxon', DefaultMenuTaxonStory::class)
            ->tag('foundry.story')
        ->alias(DefaultMenuTaxonStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_menu_taxon')

        ->set('sylius.fixtures_plugin.story.default_payment_methods', DefaultPaymentMethodsStory::class)
            ->tag('foundry.story')
        ->alias(DefaultPaymentMethodsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_payment_methods')

        ->set('sylius.fixtures_plugin.story.default_shipping_methods', DefaultShippingMethodsStory::class)
            ->tag('foundry.story')
        ->alias(DefaultShippingMethodsStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_shipping_methods')

        ->set('sylius.fixtures_plugin.story.default_shop_users', DefaultShopUsersStory::class)
            ->tag('foundry.story')
        ->alias(DefaultShopUsersStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_shop_users')

        ->set('sylius.fixtures_plugin.story.default_tax_categories', DefaultTaxCategoriesStory::class)
            ->tag('foundry.story')
        ->alias(DefaultTaxCategoriesStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_tax_category')

        ->set('sylius.fixtures_plugin.story.default_tax_rates', DefaultTaxRatesStory::class)
            ->tag('foundry.story')
        ->alias(DefaultTaxRatesStoryInterface::class, 'sylius.fixtures_plugin.foundry.story.default_tax_rates')
    ;
};
