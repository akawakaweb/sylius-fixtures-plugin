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

use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\Initiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\PaymentMethodInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAttributeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShopUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\TaxonInitiator;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.initiator.address', Initiator::class)
            ->args([
                service('sylius.factory.address'),
                service('sylius.shop_fixtures.updater.address'),
            ])

        ->set('sylius.shop_fixtures.initiator.admin_user', Initiator::class)
            ->args([
                service('sylius.factory.admin_user'),
                service('sylius.shop_fixtures.updater.admin_user'),
            ])

        ->set('sylius.shop_fixtures.initiator.catalog_promotion_action', Initiator::class)
            ->args([
                service('sylius.factory.catalog_promotion_action'),
                service('sylius.shop_fixtures.updater.catalog_promotion_action'),
            ])

        ->set('sylius.shop_fixtures.initiator.catalog_promotion', Initiator::class)
            ->args([
                service('sylius.factory.catalog_promotion'),
                service('sylius.shop_fixtures.updater.catalog_promotion'),
            ])

        ->set('sylius.shop_fixtures.initiator.catalog_promotion_scope', Initiator::class)
            ->args([
                service('sylius.factory.catalog_promotion_scope'),
                service('sylius.shop_fixtures.updater.catalog_promotion_scope'),
            ])

        ->set('sylius.shop_fixtures.initiator.channel', Initiator::class)
            ->args([
                service('sylius.factory.channel'),
                service('sylius.shop_fixtures.updater.channel'),
            ])

        ->set('sylius.shop_fixtures.initiator.country', Initiator::class)
            ->args([
                service('sylius.factory.country'),
                service('sylius.shop_fixtures.updater.country'),
            ])

        ->set('sylius.shop_fixtures.initiator.currency', Initiator::class)
            ->args([
                service('sylius.factory.currency'),
                service('sylius.shop_fixtures.updater.currency'),
            ])

        ->set('sylius.shop_fixtures.initiator.customer', Initiator::class)
            ->args([
                service('sylius.factory.customer'),
                service('sylius.shop_fixtures.updater.customer'),
            ])

        ->set('sylius.shop_fixtures.initiator.customer_group', Initiator::class)
            ->args([
                service('sylius.factory.customer_group'),
                service('sylius.shop_fixtures.updater.customer_group'),
            ])

        ->set('sylius.shop_fixtures.initiator.locale', Initiator::class)
            ->args([
                service('sylius.factory.locale'),
                service('sylius.shop_fixtures.updater.locale'),
            ])

        ->set('sylius.shop_fixtures.initiator.order', Initiator::class)
            ->args([
                service('sylius.factory.order'),
                service('sylius.shop_fixtures.updater.order'),
            ])

        ->set('sylius.shop_fixtures.initiator.payment_method', PaymentMethodInitiator::class)
            ->args([
                service('sylius.factory.payment_method'),
                service('sylius.shop_fixtures.updater.payment_method'),
            ])

        ->set('sylius.shop_fixtures.initiator.product_association', Initiator::class)
            ->args([
                service('sylius.factory.product_association'),
                service('sylius.shop_fixtures.updater.product_association'),
            ])

        ->set('sylius.shop_fixtures.initiator.product_association_type', Initiator::class)
            ->args([
                service('sylius.factory.product_association_type'),
                service('sylius.shop_fixtures.updater.product_association_type'),
            ])

        ->set('sylius.shop_fixtures.initiator.product_attribute', ProductAttributeInitiator::class)
            ->args([
                service('sylius.factory.product_attribute'),
                service('sylius.shop_fixtures.updater.product_attribute'),
            ])

        ->set('sylius.shop_fixtures.initiator.product', Initiator::class)
            ->args([
                service('sylius.factory.product'),
                service('sylius.shop_fixtures.updater.product'),
            ])

        ->set('sylius.shop_fixtures.initiator.product_review', Initiator::class)
            ->args([
                service('sylius.factory.product_review'),
                service('sylius.shop_fixtures.updater.product_review'),
            ])

        ->set('sylius.shop_fixtures.initiator.promotion', Initiator::class)
            ->args([
                service('sylius.factory.promotion'),
                service('sylius.shop_fixtures.updater.promotion'),
            ])

        ->set('sylius.shop_fixtures.initiator.promotion_action', Initiator::class)
            ->args([
                service('sylius.factory.promotion_action'),
                service('sylius.shop_fixtures.updater.promotion_action'),
            ])

        ->set('sylius.shop_fixtures.initiator.promotion_rule', Initiator::class)
            ->args([
                service('sylius.factory.promotion_rule'),
                service('sylius.shop_fixtures.updater.promotion_rule'),
            ])

        ->set('sylius.shop_fixtures.initiator.shipping_category', Initiator::class)
            ->args([
                service('sylius.factory.shipping_category'),
                service('sylius.shop_fixtures.updater.shipping_category'),
            ])

        ->set('sylius.shop_fixtures.initiator.shipping_method', Initiator::class)
            ->args([
                service('sylius.factory.shipping_method'),
                service('sylius.shop_fixtures.updater.shipping_method'),
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
                service('sylius.shop_fixtures.updater.tax_category'),
            ])

        ->set('sylius.shop_fixtures.initiator.tax_rate', Initiator::class)
            ->args([
                service('sylius.factory.tax_rate'),
                service('sylius.shop_fixtures.updater.tax_rate'),
            ])

        ->set('sylius.shop_fixtures.initiator.taxon', TaxonInitiator::class)
            ->args([
                service('sylius.factory.taxon'),
                service('sylius.repository.taxon'),
                service('sylius.shop_fixtures.updater.taxon'),
            ])

        ->set('sylius.shop_fixtures.initiator.zone', Initiator::class)
            ->args([
                service('sylius.factory.zone'),
                service('sylius.shop_fixtures.updater.zone'),
            ])

        ->set('sylius.shop_fixtures.initiator.zone_member', Initiator::class)
            ->args([
                service('sylius.factory.zone_member'),
                service('sylius.shop_fixtures.updater.zone_member'),
            ])
    ;
};
