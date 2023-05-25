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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator\Initiator;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator\PaymentMethodInitiator;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator\ProductAttributeInitiator;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator\ShopUserInitiator;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator\TaxonInitiator;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.fixtures_plugin.initiator.address', Initiator::class)
            ->args([
                service('sylius.factory.address'),
                service('sylius.fixtures_plugin.updater.address'),
            ])

        ->set('sylius.fixtures_plugin.initiator.admin_user', Initiator::class)
            ->args([
                service('sylius.factory.admin_user'),
                service('sylius.fixtures_plugin.updater.admin_user'),
            ])

        ->set('sylius.fixtures_plugin.initiator.catalog_promotion_action', Initiator::class)
            ->args([
                service('sylius.factory.catalog_promotion_action'),
                service('sylius.fixtures_plugin.updater.catalog_promotion_action'),
            ])

        ->set('sylius.fixtures_plugin.initiator.catalog_promotion', Initiator::class)
            ->args([
                service('sylius.factory.catalog_promotion'),
                service('sylius.fixtures_plugin.updater.catalog_promotion'),
            ])

        ->set('sylius.fixtures_plugin.initiator.catalog_promotion_scope', Initiator::class)
            ->args([
                service('sylius.factory.catalog_promotion_scope'),
                service('sylius.fixtures_plugin.updater.catalog_promotion_scope'),
            ])

        ->set('sylius.fixtures_plugin.initiator.channel', Initiator::class)
            ->args([
                service('sylius.factory.channel'),
                service('sylius.fixtures_plugin.updater.channel'),
            ])

        ->set('sylius.fixtures_plugin.initiator.country', Initiator::class)
            ->args([
                service('sylius.factory.country'),
                service('sylius.fixtures_plugin.updater.country'),
            ])

        ->set('sylius.fixtures_plugin.initiator.currency', Initiator::class)
            ->args([
                service('sylius.factory.currency'),
                service('sylius.fixtures_plugin.updater.currency'),
            ])

        ->set('sylius.fixtures_plugin.initiator.customer', Initiator::class)
            ->args([
                service('sylius.factory.customer'),
                service('sylius.fixtures_plugin.updater.customer'),
            ])

        ->set('sylius.fixtures_plugin.initiator.customer_group', Initiator::class)
            ->args([
                service('sylius.factory.customer_group'),
                service('sylius.fixtures_plugin.updater.customer_group'),
            ])

        ->set('sylius.fixtures_plugin.initiator.locale', Initiator::class)
            ->args([
                service('sylius.factory.locale'),
                service('sylius.fixtures_plugin.updater.locale'),
            ])

        ->set('sylius.fixtures_plugin.initiator.order', Initiator::class)
            ->args([
                service('sylius.factory.order'),
                service('sylius.fixtures_plugin.updater.order'),
            ])

        ->set('sylius.fixtures_plugin.initiator.order_item', Initiator::class)
            ->args([
                service('sylius.factory.order_item'),
                service('sylius.fixtures_plugin.updater.order_item'),
            ])

        ->set('sylius.fixtures_plugin.initiator.payment_method', PaymentMethodInitiator::class)
            ->args([
                service('sylius.factory.payment_method'),
                service('sylius.fixtures_plugin.updater.payment_method'),
            ])

        ->set('sylius.fixtures_plugin.initiator.product_association', Initiator::class)
            ->args([
                service('sylius.factory.product_association'),
                service('sylius.fixtures_plugin.updater.product_association'),
            ])

        ->set('sylius.fixtures_plugin.initiator.product_association_type', Initiator::class)
            ->args([
                service('sylius.factory.product_association_type'),
                service('sylius.fixtures_plugin.updater.product_association_type'),
            ])

        ->set('sylius.fixtures_plugin.initiator.product_attribute', ProductAttributeInitiator::class)
            ->args([
                service('sylius.factory.product_attribute'),
                service('sylius.fixtures_plugin.updater.product_attribute'),
            ])

        ->set('sylius.fixtures_plugin.initiator.product', Initiator::class)
            ->args([
                service('sylius.factory.product'),
                service('sylius.fixtures_plugin.updater.product'),
            ])

        ->set('sylius.fixtures_plugin.initiator.product_option', Initiator::class)
            ->args([
                service('sylius.factory.product_option'),
                service('sylius.fixtures_plugin.updater.product_option'),
            ])

        ->set('sylius.fixtures_plugin.initiator.product_option_value', Initiator::class)
            ->args([
                service('sylius.factory.product_option_value'),
                service('sylius.fixtures_plugin.updater.product_option_value'),
            ])

        ->set('sylius.fixtures_plugin.initiator.product_review', Initiator::class)
            ->args([
                service('sylius.factory.product_review'),
                service('sylius.fixtures_plugin.updater.product_review'),
            ])

        ->set('sylius.fixtures_plugin.initiator.promotion', Initiator::class)
            ->args([
                service('sylius.factory.promotion'),
                service('sylius.fixtures_plugin.updater.promotion'),
            ])

        ->set('sylius.fixtures_plugin.initiator.promotion_action', Initiator::class)
            ->args([
                service('sylius.factory.promotion_action'),
                service('sylius.fixtures_plugin.updater.promotion_action'),
            ])

        ->set('sylius.fixtures_plugin.initiator.promotion_rule', Initiator::class)
            ->args([
                service('sylius.factory.promotion_rule'),
                service('sylius.fixtures_plugin.updater.promotion_rule'),
            ])

        ->set('sylius.fixtures_plugin.initiator.shipping_category', Initiator::class)
            ->args([
                service('sylius.factory.shipping_category'),
                service('sylius.fixtures_plugin.updater.shipping_category'),
            ])

        ->set('sylius.fixtures_plugin.initiator.shipping_method', Initiator::class)
            ->args([
                service('sylius.factory.shipping_method'),
                service('sylius.fixtures_plugin.updater.shipping_method'),
            ])

        ->set('sylius.fixtures_plugin.initiator.shop_user', ShopUserInitiator::class)
            ->args([
                service('sylius.factory.shop_user'),
                service('sylius.fixtures_plugin.initiator.customer'),
                param('sylius.model.customer.class'),
                service('sylius.fixtures_plugin.updater'),
            ])

        ->set('sylius.fixtures_plugin.initiator.tax_category', Initiator::class)
            ->args([
                service('sylius.factory.tax_category'),
                service('sylius.fixtures_plugin.updater.tax_category'),
            ])

        ->set('sylius.fixtures_plugin.initiator.tax_rate', Initiator::class)
            ->args([
                service('sylius.factory.tax_rate'),
                service('sylius.fixtures_plugin.updater.tax_rate'),
            ])

        ->set('sylius.fixtures_plugin.initiator.taxon', TaxonInitiator::class)
            ->args([
                service('sylius.factory.taxon'),
                service('sylius.repository.taxon'),
                service('sylius.fixtures_plugin.updater.taxon'),
            ])

        ->set('sylius.fixtures_plugin.initiator.zone', Initiator::class)
            ->args([
                service('sylius.factory.zone'),
                service('sylius.fixtures_plugin.updater.zone'),
            ])

        ->set('sylius.fixtures_plugin.initiator.zone_member', Initiator::class)
            ->args([
                service('sylius.factory.zone_member'),
                service('sylius.fixtures_plugin.updater.zone_member'),
            ])
    ;
};
