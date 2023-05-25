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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\AdminUserTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\CatalogPromotionTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\ChannelTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\CustomerGroupTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\CustomerTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\OrderTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\PaymentMethodTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\ProductAttributeTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\ProductOptionTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\ProductTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\PromotionActionTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\ShippingMethodTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\ShopUserTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\TaxCategoryTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\TaxonTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\TaxRateTransformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\Transformer;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\ZoneTransformer;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.fixtures_plugin.transformer.address', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.admin_user', AdminUserTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.catalog_promotion_action', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.catalog_promotion', CatalogPromotionTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.catalog_promotion_scope', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.channel', ChannelTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.country', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.currency', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.customer', CustomerTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.customer_group', CustomerGroupTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.locale', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.order', OrderTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.order_item', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.payment_method', PaymentMethodTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.product', ProductTransformer::class)
            ->args([
                service('sylius.generator.slug'),
                service('sylius.factory.product_attribute_value'),
            ])

        ->set('sylius.fixtures_plugin.transformer.product_association', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.product_association_type', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.product_attribute', ProductAttributeTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.product_option', ProductOptionTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.product_option_value', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.product_review', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.promotion', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.promotion_action', PromotionActionTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.promotion_rule', Transformer::class)

        ->set('sylius.fixtures_plugin.transformer.shipping_category', ShippingCategoryTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.shipping_method', ShippingMethodTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.shop_user', ShopUserTransformer::class)
            ->args([
                service('sylius.fixtures_plugin.transformer.customer'),
            ])

        ->set('sylius.fixtures_plugin.transformer.tax_category', TaxCategoryTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.tax_rate', TaxRateTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.taxon', TaxonTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.zone', ZoneTransformer::class)

        ->set('sylius.fixtures_plugin.transformer.zone_member', Transformer::class)
    ;
};
