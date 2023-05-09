<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\AddressTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\AddressTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\AdminUserTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\AdminUserTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ChannelTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ChannelTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CountryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CountryTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CurrencyTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CurrencyTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerGroupTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerGroupTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\LocaleTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\LocaleTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductAttributeTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductAttributeTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductReviewTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductReviewTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingMethodTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingMethodTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShopUserTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShopUserTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxCategoryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxCategoryTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxonTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxonTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneMemberTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneMemberTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneTransformerInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.transformer.address', AddressTransformer::class)
        ->alias(AddressTransformerInterface::class, 'sylius.shop_fixtures.transformer.address')

        ->set('sylius.shop_fixtures.transformer.admin_user', AdminUserTransformer::class)
        ->alias(AdminUserTransformerInterface::class, 'sylius.shop_fixtures.transformer.admin_user')

        ->set('sylius.shop_fixtures.transformer.channel', ChannelTransformer::class)
        ->alias(ChannelTransformerInterface::class, 'sylius.shop_fixtures.transformer.channel')

        ->set('sylius.shop_fixtures.transformer.country', CountryTransformer::class)
        ->alias(CountryTransformerInterface::class, 'sylius.shop_fixtures.transformer.country')

        ->set('sylius.shop_fixtures.transformer.currency', CurrencyTransformer::class)
        ->alias(CurrencyTransformerInterface::class, 'sylius.shop_fixtures.transformer.currency')

        ->set('sylius.shop_fixtures.transformer.customer', CustomerTransformer::class)
        ->alias(CustomerTransformerInterface::class, 'sylius.shop_fixtures.transformer.customer')

        ->set('sylius.shop_fixtures.transformer.customer_group', CustomerGroupTransformer::class)
        ->alias(CustomerGroupTransformerInterface::class, 'sylius.shop_fixtures.transformer.customer_group')

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

        ->set('sylius.shop_fixtures.transformer.product_review', ProductReviewTransformer::class)
        ->alias(ProductReviewTransformerInterface::class, 'sylius.shop_fixtures.transformer.product_review')

        ->set('sylius.shop_fixtures.transformer.shipping_category', ShippingCategoryTransformer::class)
        ->alias(ShippingCategoryTransformerInterface::class, 'sylius.shop_fixtures.transformer.shipping_category')

        ->set('sylius.shop_fixtures.transformer.shipping_method', ShippingMethodTransformer::class)
        ->alias(ShippingMethodTransformerInterface::class, 'sylius.shop_fixtures.transformer.shipping_method')

        ->set('sylius.shop_fixtures.transformer.shop_user', ShopUserTransformer::class)
            ->args([
                service('sylius.shop_fixtures.transformer.customer')
            ])
        ->alias(ShopUserTransformerInterface::class, 'sylius.shop_fixtures.transformer.shop_user')

        ->set('sylius.shop_fixtures.transformer.tax_category', TaxCategoryTransformer::class)
        ->alias(TaxCategoryTransformerInterface::class, 'sylius.shop_fixtures.transformer.tax_category')

        ->set('sylius.shop_fixtures.transformer.taxon', TaxonTransformer::class)
        ->alias(TaxonTransformerInterface::class, 'sylius.shop_fixtures.transformer.taxon')

        ->set('sylius.shop_fixtures.transformer.zone', ZoneTransformer::class)
        ->alias(ZoneTransformerInterface::class, 'sylius.shop_fixtures.transformer.zone')

        ->set('sylius.shop_fixtures.transformer.zone_member', ZoneMemberTransformer::class)
        ->alias(ZoneMemberTransformerInterface::class, 'sylius.shop_fixtures.transformer.zone_member')
    ;
};
