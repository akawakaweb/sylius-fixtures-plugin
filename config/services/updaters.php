<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerGroupInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneInitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CustomerGroupUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\LocaleUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\LocaleUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ProductAttributeUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ProductAttributeUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ProductUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ProductUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShippingCategoryUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShippingCategoryUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShippingMethodUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShippingMethodUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\TaxonUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\TaxonUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ZoneMemberUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ZoneMemberUpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.updater.locale', LocaleUpdater::class)
        ->alias(LocaleUpdaterInterface::class, 'sylius.shop_fixtures.updater.locale')

        ->set('sylius.shop_fixtures.updater.product', ProductUpdater::class)
            ->args([
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
        ->alias(ProductUpdaterInterface::class, 'sylius.shop_fixtures.updater.product')

        ->set('sylius.shop_fixtures.updater.product_attribute', ProductAttributeUpdater::class)
        ->alias(ProductAttributeUpdaterInterface::class, 'sylius.shop_fixtures.updater.product_attribute')

        ->set('sylius.shop_fixtures.updater.shipping_method', ShippingMethodUpdater::class)
        ->alias(ShippingMethodUpdaterInterface::class, 'sylius.shop_fixtures.updater.shipping_method')

        ->set('sylius.shop_fixtures.updater.shipping_category', ShippingCategoryUpdater::class)
        ->alias(ShippingCategoryUpdaterInterface::class, 'sylius.shop_fixtures.updater.shipping_category')

        ->set('sylius.shop_fixtures.updater.taxon', TaxonUpdater::class)
            ->args([
                service('sylius.generator.taxon_slug'),
            ])
        ->alias(TaxonUpdaterInterface::class, 'sylius.shop_fixtures.updater.taxon')

        ->set('sylius.shop_fixtures.updater.zone_member', ZoneMemberUpdater::class)
        ->alias(ZoneMemberUpdaterInterface::class, 'sylius.shop_fixtures.updater.zone_member')
    ;
};
