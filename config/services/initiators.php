<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AddressInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AdminUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CatalogPromotionActionInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CatalogPromotionInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CatalogPromotionScopeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ChannelInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CountryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CurrencyInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerGroupInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\Initiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\LocaleInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAssociationInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAssociationTypeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAttributeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductReviewInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\PromotionRuleInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShippingCategoryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShippingMethodInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShopUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\TaxCategoryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\TaxonInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneMemberInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\Updater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.initiator.address', Initiator::class)
            ->args([
                service('sylius.factory.address'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.admin_user', AdminUserInitiator::class)
            ->args([
                service('sylius.factory.admin_user'),
                service('sylius.factory.avatar_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.catalog_promotion_action', Initiator::class)
            ->args([
                service('sylius.factory.catalog_promotion_action'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.catalog_promotion', CatalogPromotionInitiator::class)
            ->args([
                service('sylius.factory.catalog_promotion'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.catalog_promotion_scope', Initiator::class)
            ->args([
                service('sylius.factory.catalog_promotion_scope'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.channel', ChannelInitiator::class)
            ->args([
                service('sylius.factory.channel'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.country', Initiator::class)
            ->args([
                service('sylius.factory.country'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.currency', Initiator::class)
            ->args([
                service('sylius.factory.currency'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.customer', CustomerInitiator::class)
            ->args([
                service('sylius.factory.customer'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.customer_group', Initiator::class)
            ->args([
                service('sylius.factory.customer_group'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.locale', Initiator::class)
            ->args([
                service('sylius.factory.locale'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.product_association', Initiator::class)
            ->args([
                service('sylius.factory.product_association'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.product_association_type', Initiator::class)
            ->args([
                service('sylius.factory.product_association_type'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.product_attribute', ProductAttributeInitiator::class)
            ->args([
                service('sylius.factory.product_attribute'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.product', ProductInitiator::class)
            ->args([
                service('sylius.factory.product'),
                service('sylius.factory.product_variant'),
                service('sylius.factory.channel_pricing'),
                service('sylius.generator.product_variant'),
                service('sylius.factory.product_taxon'),
                service('sylius.factory.product_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
                service('sylius.shop_fixtures.updater')
            ])

        ->set('sylius.shop_fixtures.initiator.product_review', Initiator::class)
            ->args([
                service('sylius.factory.product_review'),
                service('sylius.shop_fixtures.updater')
            ])

        ->set('sylius.shop_fixtures.initiator.promotion', Initiator::class)
            ->args([
                service('sylius.factory.promotion'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.promotion_action', Initiator::class)
            ->args([
                service('sylius.factory.promotion_action'),
                service('sylius.shop_fixtures.updater')
            ])

        ->set('sylius.shop_fixtures.initiator.promotion_rule', Initiator::class)
            ->args([
                service('sylius.factory.promotion_rule'),
                service('sylius.shop_fixtures.updater')
            ])

        ->set('sylius.shop_fixtures.initiator.shipping_category', Initiator::class)
            ->args([
                service('sylius.factory.shipping_category'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.shipping_method', ShippingMethodInitiator::class)
            ->args([
                service('sylius.factory.shipping_method'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.shop_user', ShopUserInitiator::class)
            ->args([
                service('sylius.factory.shop_user'),
                service('sylius.shop_fixtures.initiator.customer'),
                param('sylius.model.customer.class'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.tax_category', Initiator::class)
            ->args([
                service('sylius.factory.tax_category'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.taxon', TaxonInitiator::class)
            ->args([
                service('sylius.factory.taxon'),
                service('sylius.repository.taxon'),
                service('sylius.generator.taxon_slug'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.zone', Initiator::class)
            ->args([
                service('sylius.factory.zone'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.zone_member', Initiator::class)
            ->args([
                service('sylius.factory.zone_member'),
                service('sylius.shop_fixtures.updater'),
            ])
    ;
};
