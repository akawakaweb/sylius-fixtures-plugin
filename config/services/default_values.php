<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CountryDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CountryDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CurrencyDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CurrencyDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\LocaleDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\LocaleDefaultValuesInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.default_values.country', CountryDefaultValues::class)
        ->alias(CountryDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.country')

        ->set('sylius.shop_fixtures.default_values.currency', CurrencyDefaultValues::class)
        ->alias(CurrencyDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.currency')

        ->set('sylius.shop_fixtures.default_values.customer', CustomerDefaultValues::class)
        ->alias(CustomerDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.customer')

        ->set('sylius.shop_fixtures.default_values.locale', LocaleDefaultValues::class)
        ->alias(LocaleDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.locale')
    ;
};
