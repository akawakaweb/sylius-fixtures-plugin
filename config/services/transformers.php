<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CountryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CountryTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CurrencyTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CurrencyTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\LocaleTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\LocaleTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductAttributeTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductAttributeTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneTransformerInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.transformer.country', CountryTransformer::class)
        ->alias(CountryTransformerInterface::class, 'sylius.shop_fixtures.transformer.country')

        ->set('sylius.shop_fixtures.transformer.currency', CurrencyTransformer::class)
        ->alias(CurrencyTransformerInterface::class, 'sylius.shop_fixtures.transformer.currency')

        ->set('sylius.shop_fixtures.transformer.customer', CustomerTransformer::class)
        ->alias(CustomerTransformerInterface::class, 'sylius.shop_fixtures.transformer.customer')

        ->set('sylius.shop_fixtures.transformer.locale', LocaleTransformer::class)
        ->alias(LocaleTransformerInterface::class, 'sylius.shop_fixtures.transformer.locale')

        ->set('sylius.shop_fixtures.transformer.product', ProductTransformer::class)
            ->args([
                service('sylius.generator.slug'),
                service('sylius.factory.product_attribute_value'),
            ])
        ->alias(ProductTransformerInterface::class, 'sylius.shop_fixtures.transformer.product')

        ->set('sylius.shop_fixtures.transformer.product_attribute', ProductAttributeTransformer::class)
        ->alias(ProductAttributeTransformerInterface::class, 'sylius.shop_fixtures.transformer.product_attribute')

        ->set('sylius.shop_fixtures.transformer.shipping_category', ShippingCategoryTransformer::class)
        ->alias(ShippingCategoryTransformerInterface::class, 'sylius.shop_fixtures.transformer.shipping_category')

        ->set('sylius.shop_fixtures.transformer.zone', ZoneTransformer::class)
        ->alias(ZoneTransformerInterface::class, 'sylius.shop_fixtures.transformer.zone')
    ;
};
