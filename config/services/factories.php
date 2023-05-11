<?php

/*
 * This file is part of ShopFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Configurator\FactoryConfigurator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\AddressFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\AdminUserFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CatalogPromotionActionFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CatalogPromotionFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CatalogPromotionScopeFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CountryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerGroupFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\FactoryWithModelClassAwareInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\OrderFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\PaymentMethodFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductAssociationFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductAssociationTypeFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductAttributeFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductReviewFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\PromotionActionFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\PromotionFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\PromotionRuleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShippingCategoryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShippingMethodFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShopUserFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxCategoryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxonFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxRateFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ZoneFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ZoneMemberFactory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->instanceof(FactoryWithModelClassAwareInterface::class)
            ->configurator([service('sylius.shop_fixtures.factory.configurator'), 'configure'])

        ->set('sylius.shop_fixtures.factory.configurator', FactoryConfigurator::class)
            ->args([
                service('sylius.resource_registry'),
            ])

        ->set('sylius.shop_fixtures.factory.address', AddressFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.address'),
                service('sylius.shop_fixtures.transformer.address'),
                service('sylius.shop_fixtures.initiator.address'),
            ])
            ->tag('foundry.factory')
        ->alias(AddressFactory::class, 'sylius.shop_fixtures.factory.address')

        ->set('sylius.shop_fixtures.factory.admin_user', AdminUserFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.admin_user'),
                service('sylius.shop_fixtures.transformer.admin_user'),
                service('sylius.shop_fixtures.initiator.admin_user'),
            ])
            ->tag('foundry.factory')
        ->alias(AdminUserFactory::class, 'sylius.shop_fixtures.factory.admin_user')

        ->set('sylius.shop_fixtures.factory.catalog_promotion_action', CatalogPromotionActionFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.catalog_promotion_action'),
                service('sylius.shop_fixtures.transformer.catalog_promotion_action'),
                service('sylius.shop_fixtures.initiator.catalog_promotion_action'),
            ])
            ->tag('foundry.factory')
        ->alias(CatalogPromotionActionFactory::class, 'sylius.shop_fixtures.factory.catalog_promotion_action')

        ->set('sylius.shop_fixtures.factory.catalog_promotion', CatalogPromotionFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.catalog_promotion'),
                service('sylius.shop_fixtures.transformer.catalog_promotion'),
                service('sylius.shop_fixtures.initiator.catalog_promotion'),
            ])
            ->tag('foundry.factory')
        ->alias(CatalogPromotionFactory::class, 'sylius.shop_fixtures.factory.catalog_promotion')

        ->set('sylius.shop_fixtures.factory.catalog_promotion_scope', CatalogPromotionScopeFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.catalog_promotion_scope'),
                service('sylius.shop_fixtures.transformer.catalog_promotion_scope'),
                service('sylius.shop_fixtures.initiator.catalog_promotion_scope'),
            ])
            ->tag('foundry.factory')
        ->alias(CatalogPromotionScopeFactory::class, 'sylius.shop_fixtures.factory.catalog_promotion_scope')

        ->set('sylius.shop_fixtures.factory.channel', ChannelFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.channel'),
                service('sylius.shop_fixtures.transformer.channel'),
                service('sylius.shop_fixtures.initiator.channel'),
            ])
            ->tag('foundry.factory')
        ->alias(ChannelFactory::class, 'sylius.shop_fixtures.factory.channel')

        ->set('sylius.shop_fixtures.factory.country', CountryFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.country'),
                service('sylius.shop_fixtures.transformer.country'),
                service('sylius.shop_fixtures.initiator.country'),
            ])
            ->tag('foundry.factory')
        ->alias(CountryFactory::class, 'sylius.shop_fixtures.factory.country')

        ->set('sylius.shop_fixtures.factory.currency', CurrencyFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.currency'),
                service('sylius.shop_fixtures.transformer.currency'),
                service('sylius.shop_fixtures.initiator.currency'),
            ])
            ->tag('foundry.factory')
        ->alias(CurrencyFactory::class, 'sylius.shop_fixtures.factory.currency')

        ->set('sylius.shop_fixtures.factory.customer', CustomerFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.customer'),
                service('sylius.shop_fixtures.transformer.customer'),
                service('sylius.shop_fixtures.initiator.customer'),
            ])
            ->tag('foundry.factory')
        ->alias(CustomerFactory::class, 'sylius.shop_fixtures.factory.customer')

        ->set('sylius.shop_fixtures.factory.customer_group', CustomerGroupFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.customer_group'),
                service('sylius.shop_fixtures.transformer.customer_group'),
                service('sylius.shop_fixtures.initiator.customer_group'),
            ])
            ->tag('foundry.factory')
        ->alias(CustomerGroupFactory::class, 'sylius.shop_fixtures.factory.customer_group')

        ->set('sylius.shop_fixtures.factory.locale', LocaleFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.locale'),
                service('sylius.shop_fixtures.transformer.locale'),
                service('sylius.shop_fixtures.initiator.locale'),
            ])
            ->tag('foundry.factory')
        ->alias(LocaleFactory::class, 'sylius.shop_fixtures.factory.locale')

        ->set('sylius.shop_fixtures.factory.order', OrderFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.order'),
                service('sylius.shop_fixtures.transformer.order'),
                service('sylius.shop_fixtures.initiator.order'),
            ])
            ->tag('foundry.factory')
        ->alias(OrderFactory::class, 'sylius.shop_fixtures.factory.order')

        ->set('sylius.shop_fixtures.factory.payment_method', PaymentMethodFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.payment_method'),
                service('sylius.shop_fixtures.transformer.payment_method'),
                service('sylius.shop_fixtures.initiator.payment_method'),
            ])
            ->tag('foundry.factory')
        ->alias(PaymentMethodFactory::class, 'sylius.shop_fixtures.factory.payment_method')

        ->set('sylius.shop_fixtures.factory.product', ProductFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.product'),
                service('sylius.shop_fixtures.transformer.product'),
                service('sylius.shop_fixtures.initiator.product'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductFactory::class, 'sylius.shop_fixtures.factory.product')

        ->set('sylius.shop_fixtures.factory.product_association', ProductAssociationFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.product_association'),
                service('sylius.shop_fixtures.transformer.product_association'),
                service('sylius.shop_fixtures.initiator.product_association'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductAssociationFactory::class, 'sylius.shop_fixtures.factory.product_association')

        ->set('sylius.shop_fixtures.factory.product_association_type', ProductAssociationTypeFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.product_association_type'),
                service('sylius.shop_fixtures.transformer.product_association_type'),
                service('sylius.shop_fixtures.initiator.product_association_type'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductAssociationTypeFactory::class, 'sylius.shop_fixtures.factory.product_association_type')

        ->set('sylius.shop_fixtures.factory.product_attribute', ProductAttributeFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.product_attribute'),
                service('sylius.shop_fixtures.transformer.product_attribute'),
                service('sylius.shop_fixtures.initiator.product_attribute'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductAttributeFactory::class, 'sylius.shop_fixtures.factory.product_attribute')

        ->set('sylius.shop_fixtures.factory.product_review', ProductReviewFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.product_review'),
                service('sylius.shop_fixtures.transformer.product_review'),
                service('sylius.shop_fixtures.initiator.product_review'),
            ])
            ->tag('foundry.factory')
        ->alias(ProductReviewFactory::class, 'sylius.shop_fixtures.factory.product_review')

        ->set('sylius.shop_fixtures.factory.promotion_action', PromotionActionFactory::class)
            ->args([
                    service('sylius.shop_fixtures.default_values.promotion_action'),
                    service('sylius.shop_fixtures.transformer.promotion_action'),
                    service('sylius.shop_fixtures.initiator.promotion_action'),
            ])
            ->tag('foundry.factory')
        ->alias(PromotionActionFactory::class, 'sylius.shop_fixtures.factory.promotion_action')

        ->set('sylius.shop_fixtures.factory.promotion', PromotionFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.promotion'),
                service('sylius.shop_fixtures.transformer.promotion'),
                service('sylius.shop_fixtures.initiator.promotion'),
            ])
            ->tag('foundry.factory')
        ->alias(PromotionFactory::class, 'sylius.shop_fixtures.factory.promotion')

        ->set('sylius.shop_fixtures.factory.promotion_rule', PromotionRuleFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.promotion_rule'),
                service('sylius.shop_fixtures.transformer.promotion_rule'),
                service('sylius.shop_fixtures.initiator.promotion_rule'),
            ])
            ->tag('foundry.factory')
        ->alias(PromotionRuleFactory::class, 'sylius.shop_fixtures.factory.promotion_rule')

        ->set('sylius.shop_fixtures.factory.shipping_category', ShippingCategoryFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.shipping_category'),
                service('sylius.shop_fixtures.transformer.shipping_category'),
                service('sylius.shop_fixtures.initiator.shipping_category'),
            ])
            ->tag('foundry.factory')
        ->alias(ShippingCategoryFactory::class, 'sylius.shop_fixtures.factory.shipping_category')

        ->set('sylius.shop_fixtures.factory.shipping_method', ShippingMethodFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.shipping_method'),
                service('sylius.shop_fixtures.transformer.shipping_method'),
                service('sylius.shop_fixtures.initiator.shipping_method'),
            ])
            ->tag('foundry.factory')
        ->alias(ShippingMethodFactory::class, 'sylius.shop_fixtures.factory.shipping_method')

        ->set('sylius.shop_fixtures.factory.shop_user', ShopUserFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.shop_user'),
                service('sylius.shop_fixtures.transformer.shop_user'),
                service('sylius.shop_fixtures.initiator.shop_user'),
            ])
            ->tag('foundry.factory')
        ->alias(ShopUserFactory::class, 'sylius.shop_fixtures.factory.shop_user')

        ->set('sylius.shop_fixtures.factory.tax_category', TaxCategoryFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.tax_category'),
                service('sylius.shop_fixtures.transformer.tax_category'),
                service('sylius.shop_fixtures.initiator.tax_category'),
            ])
            ->tag('foundry.factory')
        ->alias(TaxCategoryFactory::class, 'sylius.shop_fixtures.factory.tax_category')

        ->set('sylius.shop_fixtures.factory.tax_rate', TaxRateFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.tax_rate'),
                service('sylius.shop_fixtures.transformer.tax_rate'),
                service('sylius.shop_fixtures.initiator.tax_rate'),
            ])
            ->tag('foundry.factory')
        ->alias(TaxRateFactory::class, 'sylius.shop_fixtures.factory.tax_rate')

        ->set('sylius.shop_fixtures.factory.taxon', TaxonFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.taxon'),
                service('sylius.shop_fixtures.transformer.taxon'),
                service('sylius.shop_fixtures.initiator.taxon'),
            ])
            ->tag('foundry.factory')
        ->alias(TaxonFactory::class, 'sylius.shop_fixtures.factory.taxon')

        ->set('sylius.shop_fixtures.factory.zone', ZoneFactory::class)
            ->args([
                    service('sylius.shop_fixtures.default_values.zone'),
                    service('sylius.shop_fixtures.transformer.zone'),
                    service('sylius.shop_fixtures.initiator.zone'),
            ])
            ->tag('foundry.factory')
        ->alias(ZoneFactory::class, 'sylius.shop_fixtures.factory.zone')

        ->set('sylius.shop_fixtures.factory.zone_member', ZoneMemberFactory::class)
            ->args([
                service('sylius.shop_fixtures.default_values.zone_member'),
                service('sylius.shop_fixtures.transformer.zone_member'),
                service('sylius.shop_fixtures.initiator.zone_member'),
            ])
            ->tag('foundry.factory')
        ->alias(ZoneMemberFactory::class, 'sylius.shop_fixtures.factory.zone_member')
    ;
};
