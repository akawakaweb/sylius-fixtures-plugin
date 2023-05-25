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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\AdminUserUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\CatalogPromotionUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\ChannelUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\OrderItemUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\OrderUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\PaymentMethodUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\ProductAttributeUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\ProductOptionUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\ProductOptionValueUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\ProductUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\ShippingMethodUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\TaxonUpdater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\Updater;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\UpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.fixtures_plugin.updater', Updater::class)
        ->alias(UpdaterInterface::class, 'sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.address')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.admin_user', AdminUserUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
                service('sylius.factory.avatar_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
            ])

        ->set('sylius.fixtures_plugin.updater.catalog_promotion_action')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.catalog_promotion', CatalogPromotionUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.updater.catalog_promotion_scope')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.channel', ChannelUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.updater.country')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.currency')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.customer')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.customer_group')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.locale')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.order', OrderUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
                service('sm.factory'),
                service('sylius.repository.shipping_method'),
            ])

        ->set('sylius.fixtures_plugin.updater.order_item', OrderItemUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
                service('sylius.order_item_quantity_modifier'),
            ])

        ->set('sylius.fixtures_plugin.updater.payment_method', PaymentMethodUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.updater.product_association')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.product_association_type')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.product_attribute', ProductAttributeUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.updater.product', ProductUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
                service('sylius.factory.product_variant'),
                service('sylius.factory.channel_pricing'),
                service('sylius.generator.product_variant'),
                service('sylius.factory.product_taxon'),
                service('sylius.factory.product_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.updater.product_option', ProductOptionUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.updater.product_option_value', ProductOptionValueUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.updater.product_review')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.promotion')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.promotion_action')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.promotion_rule')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.shipping_category')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.shipping_method', ShippingMethodUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.updater.tax_category')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.tax_rate')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.taxon', TaxonUpdater::class)
            ->args([
                service('sylius.fixtures_plugin.updater'),
                service('sylius.generator.taxon_slug'),
            ])

        ->set('sylius.fixtures_plugin.updater.zone')
            ->parent('sylius.fixtures_plugin.updater')

        ->set('sylius.fixtures_plugin.updater.zone_member')
            ->parent('sylius.fixtures_plugin.updater')
    ;
};
