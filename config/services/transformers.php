<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CountryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CountryTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CurrencyTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CurrencyTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\LocaleTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\LocaleTransformerInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.transformer.country', CountryTransformer::class)
        ->alias(CountryTransformerInterface::class, 'sylius.shop_fixtures.transformer.country')

        ->set('sylius.shop_fixtures.transformer.currency', CurrencyTransformer::class)
        ->alias(CurrencyTransformerInterface::class, 'sylius.shop_fixtures.transformer.currency')

        ->set('sylius.shop_fixtures.transformer.locale', LocaleTransformer::class)
        ->alias(LocaleTransformerInterface::class, 'sylius.shop_fixtures.transformer.locale')
    ;
};
