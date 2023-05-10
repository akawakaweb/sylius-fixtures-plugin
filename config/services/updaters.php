<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\AdminUserUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CatalogPromotionUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ChannelUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ProductAttributeUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ProductUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShippingMethodUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\TaxonUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\Updater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.updater', Updater::class)
        ->alias(UpdaterInterface::class, 'sylius.shop_fixtures.updater')

        ->set('sylius.shop_fixtures.updater.admin_user', AdminUserUpdater::class)
            ->args([
                service('sylius.shop_fixtures.updater'),
                service('sylius.factory.avatar_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.updater.catalog_promotion', CatalogPromotionUpdater::class)
            ->args([
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.updater.channel', ChannelUpdater::class)
            ->args([
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.updater.product_attribute', ProductAttributeUpdater::class)
            ->args([
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.updater.product', ProductUpdater::class)
            ->args([
                service('sylius.shop_fixtures.updater'),
                service('sylius.factory.product_variant'),
                service('sylius.factory.channel_pricing'),
                service('sylius.generator.product_variant'),
                service('sylius.factory.product_taxon'),
                service('sylius.factory.product_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
                service('sylius.shop_fixtures.updater')
            ])

        ->set('sylius.shop_fixtures.updater.shipping_method', ShippingMethodUpdater::class)
            ->args([
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.updater.taxon', TaxonUpdater::class)
            ->args([
                service('sylius.shop_fixtures.updater'),
                service('sylius.generator.taxon_slug'),
            ])
    ;
};
