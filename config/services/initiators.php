<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AdminUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ChannelInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\Initiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\InitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAttributeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShippingMethodInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShopUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\TaxonInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\Updater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.updater', Updater::class)
        ->alias(UpdaterInterface::class, 'sylius.shop_fixtures.updater')

        ->set('sylius.shop_fixtures.initiator', Initiator::class)
            ->call('allowExtraAttributes')
            ->args([
                service('sylius.shop_fixtures.updater'),
            ])
        ->alias(InitiatorInterface::class, 'sylius.shop_fixtures.initiator')

        ->set('sylius.shop_fixtures.initiator.address')->parent('sylius.shop_fixtures.initiator')

        ->set('sylius.shop_fixtures.initiator.admin_user', AdminUserInitiator::class)
            ->args([
                service('sylius.factory.admin_user'),
                service('sylius.factory.avatar_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.channel', ChannelInitiator::class)
            ->args([
                service('sylius.shop_fixtures.initiator'),
            ])

        ->set('sylius.shop_fixtures.initiator.country')->parent('sylius.shop_fixtures.initiator')

        ->set('sylius.shop_fixtures.initiator.currency')->parent('sylius.shop_fixtures.initiator')

        ->set('sylius.shop_fixtures.initiator.customer')->parent('sylius.shop_fixtures.initiator')

        ->set('sylius.shop_fixtures.initiator.customer_group')->parent('sylius.shop_fixtures.initiator')

        ->set('sylius.shop_fixtures.initiator.locale')->parent('sylius.shop_fixtures.initiator')

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

        ->set('sylius.shop_fixtures.initiator.shipping_category')->parent('sylius.shop_fixtures.initiator')

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

        ->set('sylius.shop_fixtures.initiator.tax_category')->parent('sylius.shop_fixtures.initiator')

        ->set('sylius.shop_fixtures.initiator.taxon', TaxonInitiator::class)
            ->args([
                service('sylius.factory.taxon'),
                service('sylius.repository.taxon'),
                service('sylius.generator.taxon_slug'),
                service('sylius.shop_fixtures.updater'),
            ])

        ->set('sylius.shop_fixtures.initiator.zone')->parent('sylius.shop_fixtures.initiator')

        ->set('sylius.shop_fixtures.initiator.zone_member')->parent('sylius.shop_fixtures.initiator')
    ;
};
