<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CountryUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CountryUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CurrencyUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CurrencyUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CustomerUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CustomerUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\LocaleUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\LocaleUpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.updater.country', CountryUpdater::class)
        ->alias(CountryUpdaterInterface::class, 'sylius.shop_fixtures.updater.country')

        ->set('sylius.shop_fixtures.updater.currency', CurrencyUpdater::class)
        ->alias(CurrencyUpdaterInterface::class, 'sylius.shop_fixtures.updater.currency')

        ->set('sylius.shop_fixtures.updater.customer', CustomerUpdater::class)
        ->alias(CustomerUpdaterInterface::class, 'sylius.shop_fixtures.updater.customer')

        ->set('sylius.shop_fixtures.updater.locale', LocaleUpdater::class)
        ->alias(LocaleUpdaterInterface::class, 'sylius.shop_fixtures.updater.locale')
    ;
};
