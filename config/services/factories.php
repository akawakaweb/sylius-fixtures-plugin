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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Configurator\FactoryConfigurator;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\AddressFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\AdminUserFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CatalogPromotionActionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CatalogPromotionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CatalogPromotionScopeFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CountryFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CustomerFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CustomerGroupFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\FactoryWithModelClassAwareInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\OrderFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\OrderItemFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\OrderSequenceFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PaymentMethodFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAssociationFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAssociationTypeFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAttributeFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductOptionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductOptionValueFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductReviewFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionActionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionCouponFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionRuleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShippingCategoryFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShippingMethodFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShopBillingDataFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShopUserFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxCategoryFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxonFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxRateFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneMemberFactory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->instanceof(FactoryWithModelClassAwareInterface::class)
            ->configurator([service('sylius.fixtures_plugin.factory.configurator'), 'configure'])

        ->set('sylius.fixtures_plugin.factory.configurator', FactoryConfigurator::class)
            ->args([
                service('sylius.resource_registry'),
            ])

        ->set(AddressFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.address'),
                service('sylius.fixtures_plugin.transformer.address'),
                service('sylius.fixtures_plugin.initiator.address'),
            ])
            ->tag('foundry.factory')

        ->set(AdminUserFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.admin_user'),
                service('sylius.fixtures_plugin.transformer.admin_user'),
                service('sylius.fixtures_plugin.initiator.admin_user'),
            ])
            ->tag('foundry.factory')

        ->set(CatalogPromotionActionFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.catalog_promotion_action'),
                service('sylius.fixtures_plugin.transformer.catalog_promotion_action'),
                service('sylius.fixtures_plugin.initiator.catalog_promotion_action'),
            ])
            ->tag('foundry.factory')

        ->set(CatalogPromotionFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.catalog_promotion'),
                service('sylius.fixtures_plugin.transformer.catalog_promotion'),
                service('sylius.fixtures_plugin.initiator.catalog_promotion'),
            ])
            ->tag('foundry.factory')

        ->set(CatalogPromotionScopeFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.catalog_promotion_scope'),
                service('sylius.fixtures_plugin.transformer.catalog_promotion_scope'),
                service('sylius.fixtures_plugin.initiator.catalog_promotion_scope'),
            ])
            ->tag('foundry.factory')

        ->set(ChannelFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.channel'),
                service('sylius.fixtures_plugin.transformer.channel'),
                service('sylius.fixtures_plugin.initiator.channel'),
            ])
            ->tag('foundry.factory')

        ->set(CountryFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.country'),
                service('sylius.fixtures_plugin.transformer.country'),
                service('sylius.fixtures_plugin.initiator.country'),
            ])
            ->tag('foundry.factory')

        ->set(CurrencyFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.currency'),
                service('sylius.fixtures_plugin.transformer.currency'),
                service('sylius.fixtures_plugin.initiator.currency'),
            ])
            ->tag('foundry.factory')

        ->set(CustomerFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.customer'),
                service('sylius.fixtures_plugin.transformer.customer'),
                service('sylius.fixtures_plugin.initiator.customer'),
            ])
            ->tag('foundry.factory')

        ->set(CustomerGroupFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.customer_group'),
                service('sylius.fixtures_plugin.transformer.customer_group'),
                service('sylius.fixtures_plugin.initiator.customer_group'),
            ])
            ->tag('foundry.factory')

        ->set(LocaleFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.locale'),
                service('sylius.fixtures_plugin.transformer.locale'),
                service('sylius.fixtures_plugin.initiator.locale'),
            ])
            ->tag('foundry.factory')

        ->set(OrderFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.order'),
                service('sylius.fixtures_plugin.transformer.order'),
                service('sylius.fixtures_plugin.initiator.order'),
            ])
            ->tag('foundry.factory')

        ->set(OrderItemFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.order_item'),
                service('sylius.fixtures_plugin.transformer.order_item'),
                service('sylius.fixtures_plugin.initiator.order_item'),
            ])
            ->tag('foundry.factory')

        ->set(OrderSequenceFactory::class)
            ->tag('foundry.factory')

        ->set(PaymentMethodFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.payment_method'),
                service('sylius.fixtures_plugin.transformer.payment_method'),
                service('sylius.fixtures_plugin.initiator.payment_method'),
            ])
            ->tag('foundry.factory')

        ->set(ProductFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product'),
                service('sylius.fixtures_plugin.transformer.product'),
                service('sylius.fixtures_plugin.initiator.product'),
            ])
            ->tag('foundry.factory')

        ->set(ProductAssociationFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_association'),
                service('sylius.fixtures_plugin.transformer.product_association'),
                service('sylius.fixtures_plugin.initiator.product_association'),
            ])
            ->tag('foundry.factory')

        ->set(ProductAssociationTypeFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_association_type'),
                service('sylius.fixtures_plugin.transformer.product_association_type'),
                service('sylius.fixtures_plugin.initiator.product_association_type'),
            ])
            ->tag('foundry.factory')

        ->set(ProductAttributeFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_attribute'),
                service('sylius.fixtures_plugin.transformer.product_attribute'),
                service('sylius.fixtures_plugin.initiator.product_attribute'),
            ])
            ->tag('foundry.factory')

        ->set(ProductOptionFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_option'),
                service('sylius.fixtures_plugin.transformer.product_option'),
                service('sylius.fixtures_plugin.initiator.product_option'),
            ])
            ->tag('foundry.factory')

        ->set(ProductOptionValueFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_option_value'),
                service('sylius.fixtures_plugin.transformer.product_option_value'),
                service('sylius.fixtures_plugin.initiator.product_option_value'),
            ])
            ->tag('foundry.factory')

        ->set(ProductReviewFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_review'),
                service('sylius.fixtures_plugin.transformer.product_review'),
                service('sylius.fixtures_plugin.initiator.product_review'),
            ])
            ->tag('foundry.factory')

        ->set(PromotionActionFactory::class)
            ->args([
                    service('sylius.fixtures_plugin.default_values.promotion_action'),
                    service('sylius.fixtures_plugin.transformer.promotion_action'),
                    service('sylius.fixtures_plugin.initiator.promotion_action'),
            ])
            ->tag('foundry.factory')

        ->set(PromotionCouponFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.promotion_coupon'),
                service('sylius.fixtures_plugin.transformer.promotion_coupon'),
                service('sylius.fixtures_plugin.initiator.promotion_coupon'),
            ])
            ->tag('foundry.factory')

        ->set(PromotionFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.promotion'),
                service('sylius.fixtures_plugin.transformer.promotion'),
                service('sylius.fixtures_plugin.initiator.promotion'),
            ])
            ->tag('foundry.factory')

        ->set(PromotionRuleFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.promotion_rule'),
                service('sylius.fixtures_plugin.transformer.promotion_rule'),
                service('sylius.fixtures_plugin.initiator.promotion_rule'),
            ])
            ->tag('foundry.factory')

        ->set(ShippingCategoryFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.shipping_category'),
                service('sylius.fixtures_plugin.transformer.shipping_category'),
                service('sylius.fixtures_plugin.initiator.shipping_category'),
            ])
            ->tag('foundry.factory')

        ->set(ShippingMethodFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.shipping_method'),
                service('sylius.fixtures_plugin.transformer.shipping_method'),
                service('sylius.fixtures_plugin.initiator.shipping_method'),
            ])
            ->tag('foundry.factory')

        ->set(ShopBillingDataFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.shop_billing_data'),
                service('sylius.fixtures_plugin.transformer.shop_billing_data'),
                service('sylius.fixtures_plugin.initiator.shop_billing_data'),
            ])
            ->tag('foundry.factory')

        ->set(ShopUserFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.shop_user'),
                service('sylius.fixtures_plugin.transformer.shop_user'),
                service('sylius.fixtures_plugin.initiator.shop_user'),
            ])
            ->tag('foundry.factory')

        ->set(TaxCategoryFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.tax_category'),
                service('sylius.fixtures_plugin.transformer.tax_category'),
                service('sylius.fixtures_plugin.initiator.tax_category'),
            ])
            ->tag('foundry.factory')

        ->set(TaxRateFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.tax_rate'),
                service('sylius.fixtures_plugin.transformer.tax_rate'),
                service('sylius.fixtures_plugin.initiator.tax_rate'),
            ])
            ->tag('foundry.factory')

        ->set(TaxonFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.taxon'),
                service('sylius.fixtures_plugin.transformer.taxon'),
                service('sylius.fixtures_plugin.initiator.taxon'),
            ])
            ->tag('foundry.factory')

        ->set(ZoneFactory::class)
            ->args([
                    service('sylius.fixtures_plugin.default_values.zone'),
                    service('sylius.fixtures_plugin.transformer.zone'),
                    service('sylius.fixtures_plugin.initiator.zone'),
            ])
            ->tag('foundry.factory')

        ->set(ZoneMemberFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.zone_member'),
                service('sylius.fixtures_plugin.transformer.zone_member'),
                service('sylius.fixtures_plugin.initiator.zone_member'),
            ])
            ->tag('foundry.factory')
    ;
};
