<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\AddressDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\AddressDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\AdminUserDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\AdminUserDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ChannelDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ChannelDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CountryDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CountryDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CurrencyDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CurrencyDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerGroupDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerGroupDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\LocaleDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\LocaleDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductAttributeDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductAttributeDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShippingCategoryDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShippingCategoryDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShippingMethodDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShippingMethodDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShopUserDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShopUserDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\TaxCategoryDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\TaxCategoryDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\TaxonDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\TaxonDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ZoneDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ZoneDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ZoneMemberDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ZoneMemberDefaultValuesInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.default_values.address', AddressDefaultValues::class)
        ->alias(AddressDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.address')

        ->set('sylius.shop_fixtures.default_values.admin_user', AdminUserDefaultValues::class)
        ->alias(AdminUserDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.admin_user')

        ->set('sylius.shop_fixtures.default_values.channel', ChannelDefaultValues::class)
        ->alias(ChannelDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.channel')

        ->set('sylius.shop_fixtures.default_values.country', CountryDefaultValues::class)
        ->alias(CountryDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.country')

        ->set('sylius.shop_fixtures.default_values.currency', CurrencyDefaultValues::class)
        ->alias(CurrencyDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.currency')

        ->set('sylius.shop_fixtures.default_values.customer', CustomerDefaultValues::class)
        ->alias(CustomerDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.customer')

        ->set('sylius.shop_fixtures.default_values.customer_group', CustomerGroupDefaultValues::class)
        ->alias(CustomerGroupDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.customer_group')

        ->set('sylius.shop_fixtures.default_values.locale', LocaleDefaultValues::class)
        ->alias(LocaleDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.locale')

        ->set('sylius.shop_fixtures.default_values.product_attribute', ProductAttributeDefaultValues::class)
        ->alias(ProductAttributeDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.product_attribute')

        ->set('sylius.shop_fixtures.default_values.product', ProductDefaultValues::class)
        ->alias(ProductDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.product')

        ->set('sylius.shop_fixtures.default_values.shipping_category', ShippingCategoryDefaultValues::class)
        ->alias(ShippingCategoryDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.shipping_category')

        ->set('sylius.shop_fixtures.default_values.shipping_method', ShippingMethodDefaultValues::class)
        ->alias(ShippingMethodDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.shipping_method')

        ->set('sylius.shop_fixtures.default_values.shop_user', ShopUserDefaultValues::class)
            ->args([
                service('sylius.shop_fixtures.default_values.customer'),
            ])
        ->alias(ShopUserDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.shop_user')

        ->set('sylius.shop_fixtures.default_values.tax_category', TaxCategoryDefaultValues::class)
        ->alias(TaxCategoryDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.tax_category')

        ->set('sylius.shop_fixtures.default_values.taxon', TaxonDefaultValues::class)
        ->alias(TaxonDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.taxon')

        ->set('sylius.shop_fixtures.default_values.zone', ZoneDefaultValues::class)
        ->alias(ZoneDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.zone')

        ->set('sylius.shop_fixtures.default_values.zone_member', ZoneMemberDefaultValues::class)
        ->alias(ZoneMemberDefaultValuesInterface::class, 'sylius.shop_fixtures.default_values.zone_member')
    ;
};
