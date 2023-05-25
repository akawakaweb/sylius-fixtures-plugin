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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionRuleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShippingCategoryFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShippingMethodFactory;
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

        ->set('sylius.fixtures_plugin.factory.address', AddressFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.address'),
                service('sylius.fixtures_plugin.transformer.address'),
                service('sylius.fixtures_plugin.initiator.address'),
            ])
            ->tag('foundry.factory')
        ->alias(AddressFactory::class, 'sylius.fixtures_plugin.factory.address')

        ->set('sylius.fixtures_plugin.factory.admin_user', AdminUserFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.admin_user'),
                service('sylius.fixtures_plugin.transformer.admin_user'),
                service('sylius.fixtures_plugin.initiator.admin_user'),
            ])
            ->tag('foundry.factory')
        ->alias(AdminUserFactory::class, 'sylius.fixtures_plugin.factory.admin_user')

        ->set('sylius.fixtures_plugin.factory.catalog_promotion_action', CatalogPromotionActionFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.catalog_promotion_action'),
                service('sylius.fixtures_plugin.transformer.catalog_promotion_action'),
                service('sylius.fixtures_plugin.initiator.catalog_promotion_action'),
            ])
            ->tag('foundry.factory')
        ->alias(CatalogPromotionActionFactory::class, 'sylius.fixtures_plugin.factory.catalog_promotion_action')

        ->set('sylius.fixtures_plugin.factory.catalog_promotion', CatalogPromotionFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.catalog_promotion'),
                service('sylius.fixtures_plugin.transformer.catalog_promotion'),
                service('sylius.fixtures_plugin.initiator.catalog_promotion'),
            ])
            ->tag('foundry.factory')
        ->alias(CatalogPromotionFactory::class, 'sylius.fixtures_plugin.factory.catalog_promotion')

        ->set('sylius.fixtures_plugin.factory.catalog_promotion_scope', CatalogPromotionScopeFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.catalog_promotion_scope'),
                service('sylius.fixtures_plugin.transformer.catalog_promotion_scope'),
                service('sylius.fixtures_plugin.initiator.catalog_promotion_scope'),
            ])
            ->tag('foundry.factory')
        ->alias(CatalogPromotionScopeFactory::class, 'sylius.fixtures_plugin.factory.catalog_promotion_scope')

        ->set('sylius.fixtures_plugin.factory.channel', ChannelFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.channel'),
                service('sylius.fixtures_plugin.transformer.channel'),
                service('sylius.fixtures_plugin.initiator.channel'),
            ])
            ->tag('foundry.factory')
        ->alias(ChannelFactory::class, 'sylius.fixtures_plugin.factory.channel')

        ->set('sylius.fixtures_plugin.factory.country', CountryFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.country'),
                service('sylius.fixtures_plugin.transformer.country'),
                service('sylius.fixtures_plugin.initiator.country'),
            ])
            ->tag('foundry.factory')
        ->alias(CountryFactory::class, 'sylius.fixtures_plugin.factory.country')

        ->set('sylius.fixtures_plugin.factory.currency', CurrencyFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.currency'),
                service('sylius.fixtures_plugin.transformer.currency'),
                service('sylius.fixtures_plugin.initiator.currency'),
            ])
            ->tag('foundry.factory')
        ->alias(CurrencyFactory::class, 'sylius.fixtures_plugin.factory.currency')

        ->set('sylius.fixtures_plugin.factory.customer', CustomerFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.customer'),
                service('sylius.fixtures_plugin.transformer.customer'),
                service('sylius.fixtures_plugin.initiator.customer'),
            ])
            ->tag('foundry.factory')
        ->alias(CustomerFactory::class, 'sylius.fixtures_plugin.factory.customer')

        ->set('sylius.fixtures_plugin.factory.customer_group', CustomerGroupFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.customer_group'),
                service('sylius.fixtures_plugin.transformer.customer_group'),
                service('sylius.fixtures_plugin.initiator.customer_group'),
            ])
            ->tag('foundry.factory')
        ->alias(CustomerGroupFactory::class, 'sylius.fixtures_plugin.factory.customer_group')

        ->set('sylius.fixtures_plugin.factory.locale', LocaleFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.locale'),
                service('sylius.fixtures_plugin.transformer.locale'),
                service('sylius.fixtures_plugin.initiator.locale'),
            ])
            ->tag('foundry.factory')
        ->alias(LocaleFactory::class, 'sylius.fixtures_plugin.factory.locale')

        ->set('sylius.fixtures_plugin.factory.order', OrderFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.order'),
                service('sylius.fixtures_plugin.transformer.order'),
                service('sylius.fixtures_plugin.initiator.order'),
            ])
            ->tag('foundry.factory')
        ->alias(OrderFactory::class, 'sylius.fixtures_plugin.factory.order')

        ->set('sylius.fixtures_plugin.factory.order_item', OrderItemFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.order_item'),
                service('sylius.fixtures_plugin.transformer.order_item'),
                service('sylius.fixtures_plugin.initiator.order_item'),
            ])
            ->tag('foundry.factory')
        ->alias(OrderItemFactory::class, 'sylius.fixtures_plugin.factory.order_item')

        ->set('sylius.fixtures_plugin.factory.order_sequence', OrderSequenceFactory::class)
            ->tag('foundry.factory')
        ->alias(OrderSequenceFactory::class, 'sylius.fixtures_plugin.factory.order_sequence')

        ->set('sylius.fixtures_plugin.factory.payment_method', PaymentMethodFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.payment_method'),
                service('sylius.fixtures_plugin.transformer.payment_method'),
                service('sylius.fixtures_plugin.initiator.payment_method'),
            ])
            ->tag('foundry.factory')
        ->alias(PaymentMethodFactory::class, 'sylius.fixtures_plugin.factory.payment_method')

        ->set('sylius.fixtures_plugin.factory.product', ProductFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product'),
                service('sylius.fixtures_plugin.transformer.product'),
                service('sylius.fixtures_plugin.initiator.product'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductFactory::class, 'sylius.fixtures_plugin.factory.product')

        ->set('sylius.fixtures_plugin.factory.product_association', ProductAssociationFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_association'),
                service('sylius.fixtures_plugin.transformer.product_association'),
                service('sylius.fixtures_plugin.initiator.product_association'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductAssociationFactory::class, 'sylius.fixtures_plugin.factory.product_association')

        ->set('sylius.fixtures_plugin.factory.product_association_type', ProductAssociationTypeFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_association_type'),
                service('sylius.fixtures_plugin.transformer.product_association_type'),
                service('sylius.fixtures_plugin.initiator.product_association_type'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductAssociationTypeFactory::class, 'sylius.fixtures_plugin.factory.product_association_type')

        ->set('sylius.fixtures_plugin.factory.product_attribute', ProductAttributeFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_attribute'),
                service('sylius.fixtures_plugin.transformer.product_attribute'),
                service('sylius.fixtures_plugin.initiator.product_attribute'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductAttributeFactory::class, 'sylius.fixtures_plugin.factory.product_attribute')

        ->set('sylius.fixtures_plugin.factory.product_option', ProductOptionFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_option'),
                service('sylius.fixtures_plugin.transformer.product_option'),
                service('sylius.fixtures_plugin.initiator.product_option'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductOptionFactory::class, 'sylius.fixtures_plugin.factory.product_option')

        ->set('sylius.fixtures_plugin.factory.product_option_value', ProductOptionValueFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_option_value'),
                service('sylius.fixtures_plugin.transformer.product_option_value'),
                service('sylius.fixtures_plugin.initiator.product_option_value'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductOptionValueFactory::class, 'sylius.fixtures_plugin.factory.product_option_value')

        ->set('sylius.fixtures_plugin.factory.product_review', ProductReviewFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.product_review'),
                service('sylius.fixtures_plugin.transformer.product_review'),
                service('sylius.fixtures_plugin.initiator.product_review'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductReviewFactory::class, 'sylius.fixtures_plugin.factory.product_review')

        ->set('sylius.fixtures_plugin.factory.promotion_action', PromotionActionFactory::class)
            ->args([
                    service('sylius.fixtures_plugin.default_values.promotion_action'),
                    service('sylius.fixtures_plugin.transformer.promotion_action'),
                    service('sylius.fixtures_plugin.initiator.promotion_action'),
            ])
            ->tag('foundry.factory')
        ->alias(PromotionActionFactory::class, 'sylius.fixtures_plugin.factory.promotion_action')

        ->set('sylius.fixtures_plugin.factory.promotion', PromotionFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.promotion'),
                service('sylius.fixtures_plugin.transformer.promotion'),
                service('sylius.fixtures_plugin.initiator.promotion'),
            ])
            ->tag('foundry.factory')
        ->alias(PromotionFactory::class, 'sylius.fixtures_plugin.factory.promotion')

        ->set('sylius.fixtures_plugin.factory.promotion_rule', PromotionRuleFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.promotion_rule'),
                service('sylius.fixtures_plugin.transformer.promotion_rule'),
                service('sylius.fixtures_plugin.initiator.promotion_rule'),
            ])
            ->tag('foundry.factory')
        ->alias(PromotionRuleFactory::class, 'sylius.fixtures_plugin.factory.promotion_rule')

        ->set('sylius.fixtures_plugin.factory.shipping_category', ShippingCategoryFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.shipping_category'),
                service('sylius.fixtures_plugin.transformer.shipping_category'),
                service('sylius.fixtures_plugin.initiator.shipping_category'),
            ])
            ->tag('foundry.factory')
        ->alias(ShippingCategoryFactory::class, 'sylius.fixtures_plugin.factory.shipping_category')

        ->set('sylius.fixtures_plugin.factory.shipping_method', ShippingMethodFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.shipping_method'),
                service('sylius.fixtures_plugin.transformer.shipping_method'),
                service('sylius.fixtures_plugin.initiator.shipping_method'),
            ])
            ->tag('foundry.factory')
        ->alias(ShippingMethodFactory::class, 'sylius.fixtures_plugin.factory.shipping_method')

        ->set('sylius.fixtures_plugin.factory.shop_user', ShopUserFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.shop_user'),
                service('sylius.fixtures_plugin.transformer.shop_user'),
                service('sylius.fixtures_plugin.initiator.shop_user'),
            ])
            ->tag('foundry.factory')
        ->alias(ShopUserFactory::class, 'sylius.fixtures_plugin.factory.shop_user')

        ->set('sylius.fixtures_plugin.factory.tax_category', TaxCategoryFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.tax_category'),
                service('sylius.fixtures_plugin.transformer.tax_category'),
                service('sylius.fixtures_plugin.initiator.tax_category'),
            ])
            ->tag('foundry.factory')
        ->alias(TaxCategoryFactory::class, 'sylius.fixtures_plugin.factory.tax_category')

        ->set('sylius.fixtures_plugin.factory.tax_rate', TaxRateFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.tax_rate'),
                service('sylius.fixtures_plugin.transformer.tax_rate'),
                service('sylius.fixtures_plugin.initiator.tax_rate'),
            ])
            ->tag('foundry.factory')
        ->alias(TaxRateFactory::class, 'sylius.fixtures_plugin.factory.tax_rate')

        ->set('sylius.fixtures_plugin.factory.taxon', TaxonFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.taxon'),
                service('sylius.fixtures_plugin.transformer.taxon'),
                service('sylius.fixtures_plugin.initiator.taxon'),
            ])
            ->tag('foundry.factory')
        ->alias(TaxonFactory::class, 'sylius.fixtures_plugin.factory.taxon')

        ->set('sylius.fixtures_plugin.factory.zone', ZoneFactory::class)
            ->args([
                    service('sylius.fixtures_plugin.default_values.zone'),
                    service('sylius.fixtures_plugin.transformer.zone'),
                    service('sylius.fixtures_plugin.initiator.zone'),
            ])
            ->tag('foundry.factory')
        ->alias(ZoneFactory::class, 'sylius.fixtures_plugin.factory.zone')

        ->set('sylius.fixtures_plugin.factory.zone_member', ZoneMemberFactory::class)
            ->args([
                service('sylius.fixtures_plugin.default_values.zone_member'),
                service('sylius.fixtures_plugin.transformer.zone_member'),
                service('sylius.fixtures_plugin.initiator.zone_member'),
            ])
            ->tag('foundry.factory')
        ->alias(ZoneMemberFactory::class, 'sylius.fixtures_plugin.factory.zone_member')
    ;
};
