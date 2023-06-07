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

use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\AddressDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\AdminUserDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\CatalogPromotionActionDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\CatalogPromotionDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\CatalogPromotionScopeDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ChannelDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\CountryDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\CurrencyDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\CustomerDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\CustomerGroupDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\LocaleDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\OrderDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\OrderItemDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\PaymentMethodDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ProductAssociationDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ProductAssociationTypeDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ProductAttributeDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ProductDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ProductOptionDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ProductOptionValueDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ProductReviewDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\PromotionActionDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\PromotionDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\PromotionRuleDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ShippingCategoryDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ShippingMethodDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ShopBillingDataDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ShopUserDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\TaxCategoryDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\TaxonDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\TaxRateDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ZoneDefaultValues;
use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\ZoneMemberDefaultValues;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.fixtures_plugin.default_values.address', AddressDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.admin_user', AdminUserDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.catalog_promotion_action', CatalogPromotionActionDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.catalog_promotion', CatalogPromotionDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.catalog_promotion_scope', CatalogPromotionScopeDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.channel', ChannelDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.country', CountryDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.currency', CurrencyDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.customer', CustomerDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.customer_group', CustomerGroupDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.locale', LocaleDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.order', OrderDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.order_item', OrderItemDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.payment_method', PaymentMethodDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.product_association', ProductAssociationDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.product_association_type', ProductAssociationTypeDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.product_attribute', ProductAttributeDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.product', ProductDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.product_option', ProductOptionDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.product_option_value', ProductOptionValueDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.product_review', ProductReviewDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.promotion_action', PromotionActionDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.promotion', PromotionDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.promotion_rule', PromotionRuleDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.shipping_category', ShippingCategoryDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.shipping_method', ShippingMethodDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.shop_billing_data', ShopBillingDataDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.shop_user', ShopUserDefaultValues::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.customer'),
            ])

        ->set('sylius.fixtures_plugin.default_values.tax_category', TaxCategoryDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.tax_rate', TaxRateDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.taxon', TaxonDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.zone', ZoneDefaultValues::class)

        ->set('sylius.fixtures_plugin.default_values.zone_member', ZoneMemberDefaultValues::class)
    ;
};
