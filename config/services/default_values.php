<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\AddressDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\AdminUserDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CatalogPromotionActionDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CatalogPromotionDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CatalogPromotionScopeDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ChannelDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CountryDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CurrencyDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerGroupDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\LocaleDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductAssociationDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductAssociationTypeDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductAttributeDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductReviewDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\PromotionActionDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\PromotionDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\PromotionRuleDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShippingCategoryDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShippingMethodDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShopUserDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\TaxCategoryDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\TaxonDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ZoneDefaultValues;
use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ZoneMemberDefaultValues;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.default_values.address', AddressDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.admin_user', AdminUserDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.catalog_promotion_action', CatalogPromotionActionDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.catalog_promotion', CatalogPromotionDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.catalog_promotion_scope', CatalogPromotionScopeDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.channel', ChannelDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.country', CountryDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.currency', CurrencyDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.customer', CustomerDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.customer_group', CustomerGroupDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.locale', LocaleDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.product_association', ProductAssociationDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.product_association_type', ProductAssociationTypeDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.product_attribute', ProductAttributeDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.product', ProductDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.product_review', ProductReviewDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.promotion_action', PromotionActionDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.promotion', PromotionDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.promotion_rule', PromotionRuleDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.shipping_category', ShippingCategoryDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.shipping_method', ShippingMethodDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.shop_user', ShopUserDefaultValues::class)
            ->args([
                service('sylius.shop_fixtures.default_values.customer'),
            ])

        ->set('sylius.shop_fixtures.default_values.tax_category', TaxCategoryDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.taxon', TaxonDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.zone', ZoneDefaultValues::class)

        ->set('sylius.shop_fixtures.default_values.zone_member', ZoneMemberDefaultValues::class)
    ;
};
