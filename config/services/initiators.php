<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AddressInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AdminUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ChannelInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CountryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CurrencyInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerGroupInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\LocaleInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAttributeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShippingCategoryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShippingMethodInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShopUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\TaxCategoryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\TaxonInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneMemberInitiator;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.initiator.address', AddressInitiator::class)
            ->args([
                service('sylius.factory.address'),
            ])

        ->set('sylius.shop_fixtures.initiator.admin_user', AdminUserInitiator::class)
            ->args([
                service('sylius.factory.admin_user'),
                service('sylius.factory.avatar_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
            ])

        ->set('sylius.shop_fixtures.initiator.channel', ChannelInitiator::class)
            ->args([
                service('sylius.factory.channel'),
            ])

        ->set('sylius.shop_fixtures.initiator.country', CountryInitiator::class)
            ->args([
                service('sylius.factory.country'),
            ])

        ->set('sylius.shop_fixtures.initiator.currency', CurrencyInitiator::class)
            ->args([
                service('sylius.factory.currency'),
            ])

        ->set('sylius.shop_fixtures.initiator.customer', CustomerInitiator::class)
            ->args([
                service('sylius.factory.customer'),
            ])

        ->set('sylius.shop_fixtures.initiator.customer_group', CustomerGroupInitiator::class)
            ->args([
                service('sylius.factory.customer_group'),
            ])

        ->set('sylius.shop_fixtures.initiator.locale', LocaleInitiator::class)
            ->args([
                service('sylius.factory.locale'),
            ])

        ->set('sylius.shop_fixtures.initiator.product_attribute', ProductAttributeInitiator::class)
            ->args([
                service('sylius.factory.product_attribute'),
            ])

        ->set('sylius.shop_fixtures.initiator.product', ProductInitiator::class)
            ->args([
                service('sylius.factory.product'),
                service('sylius.repository.locale'),
                service('sylius.factory.product_variant'),
                service('sylius.factory.channel_pricing'),
                service('sylius.generator.product_variant'),
                service('sylius.repository.channel'),
                service('sylius.factory.product_taxon'),
                service('sylius.factory.product_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
            ])

        ->set('sylius.shop_fixtures.initiator.shipping_category', ShippingCategoryInitiator::class)
            ->args([
                service('sylius.factory.shipping_category'),
            ])

        ->set('sylius.shop_fixtures.initiator.shipping_method', ShippingMethodInitiator::class)
            ->args([
                service('sylius.factory.shipping_method'),
            ])

        ->set('sylius.shop_fixtures.initiator.shop_user', ShopUserInitiator::class)
            ->args([
                service('sylius.factory.shop_user'),
                service('sylius.shop_fixtures.initiator.customer'),
            ])

        ->set('sylius.shop_fixtures.initiator.tax_category', TaxCategoryInitiator::class)
            ->args([
                service('sylius.factory.tax_category'),
            ])

        ->set('sylius.shop_fixtures.initiator.taxon', TaxonInitiator::class)
            ->args([
                service('sylius.factory.taxon'),
                service('sylius.repository.taxon'),
                service('sylius.generator.taxon_slug'),
            ])

        ->set('sylius.shop_fixtures.initiator.zone', ZoneInitiator::class)
            ->args([
                service('sylius.factory.zone'),
            ])

        ->set('sylius.shop_fixtures.initiator.zone_member', ZoneMemberInitiator::class)
            ->args([
                service('sylius.factory.zone_member'),
            ])
    ;
};
