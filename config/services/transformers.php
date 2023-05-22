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

use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\AdminUserTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CatalogPromotionTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ChannelTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerGroupTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\OrderTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\PaymentMethodTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductAttributeTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductOptionTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\PromotionActionTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingMethodTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShopUserTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxCategoryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxonTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxRateTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\Transformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneTransformer;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.transformer.address', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.admin_user', AdminUserTransformer::class)

        ->set('sylius.shop_fixtures.transformer.catalog_promotion_action', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.catalog_promotion', CatalogPromotionTransformer::class)

        ->set('sylius.shop_fixtures.transformer.catalog_promotion_scope', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.channel', ChannelTransformer::class)

        ->set('sylius.shop_fixtures.transformer.country', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.currency', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.customer', CustomerTransformer::class)

        ->set('sylius.shop_fixtures.transformer.customer_group', CustomerGroupTransformer::class)

        ->set('sylius.shop_fixtures.transformer.locale', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.order', OrderTransformer::class)

        ->set('sylius.shop_fixtures.transformer.order_item', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.payment_method', PaymentMethodTransformer::class)

        ->set('sylius.shop_fixtures.transformer.product', ProductTransformer::class)
            ->args([
                service('sylius.generator.slug'),
                service('sylius.factory.product_attribute_value'),
            ])

        ->set('sylius.shop_fixtures.transformer.product_association', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.product_association_type', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.product_attribute', ProductAttributeTransformer::class)

        ->set('sylius.shop_fixtures.transformer.product_option', ProductOptionTransformer::class)

        ->set('sylius.shop_fixtures.transformer.product_option_value', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.product_review', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.promotion', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.promotion_action', PromotionActionTransformer::class)

        ->set('sylius.shop_fixtures.transformer.promotion_rule', Transformer::class)

        ->set('sylius.shop_fixtures.transformer.shipping_category', ShippingCategoryTransformer::class)

        ->set('sylius.shop_fixtures.transformer.shipping_method', ShippingMethodTransformer::class)

        ->set('sylius.shop_fixtures.transformer.shop_user', ShopUserTransformer::class)
            ->args([
                service('sylius.shop_fixtures.transformer.customer'),
            ])

        ->set('sylius.shop_fixtures.transformer.tax_category', TaxCategoryTransformer::class)

        ->set('sylius.shop_fixtures.transformer.tax_rate', TaxRateTransformer::class)

        ->set('sylius.shop_fixtures.transformer.taxon', TaxonTransformer::class)

        ->set('sylius.shop_fixtures.transformer.zone', ZoneTransformer::class)

        ->set('sylius.shop_fixtures.transformer.zone_member', Transformer::class)
    ;
};
