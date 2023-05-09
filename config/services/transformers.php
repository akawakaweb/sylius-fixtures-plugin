<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\AdminUserTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerGroupTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductAttributeTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingCategoryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShippingMethodTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShopUserTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxCategoryTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxonTransformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\Transformer;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneTransformer;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.transformer', Transformer::class)
        ->alias(TransformerInterface::class, 'sylius.shop_fixtures.transformer')

        ->set('sylius.shop_fixtures.transformer.address')
            ->parent('sylius.shop_fixtures.transformer')

        ->set('sylius.shop_fixtures.transformer.admin_user', AdminUserTransformer::class)

        ->set('sylius.shop_fixtures.transformer.channel')
            ->parent('sylius.shop_fixtures.transformer')

        ->set('sylius.shop_fixtures.transformer.country')
            ->parent('sylius.shop_fixtures.transformer')

        ->set('sylius.shop_fixtures.transformer.currency')
            ->parent('sylius.shop_fixtures.transformer')

        ->set('sylius.shop_fixtures.transformer.customer', CustomerTransformer::class)

        ->set('sylius.shop_fixtures.transformer.customer_group', CustomerGroupTransformer::class)

        ->set('sylius.shop_fixtures.transformer.locale')
            ->parent('sylius.shop_fixtures.transformer')

        ->set('sylius.shop_fixtures.transformer.product', ProductTransformer::class)
            ->args([
                service('sylius.generator.slug'),
                service('sylius.factory.product_attribute_value'),
            ])

        ->set('sylius.shop_fixtures.transformer.product_attribute', ProductAttributeTransformer::class)

        ->set('sylius.shop_fixtures.transformer.product_review')
            ->parent('sylius.shop_fixtures.transformer')

        ->set('sylius.shop_fixtures.transformer.shipping_category', ShippingCategoryTransformer::class)

        ->set('sylius.shop_fixtures.transformer.shipping_method', ShippingMethodTransformer::class)

        ->set('sylius.shop_fixtures.transformer.shop_user', ShopUserTransformer::class)
            ->args([
                service('sylius.shop_fixtures.transformer.customer')
            ])

        ->set('sylius.shop_fixtures.transformer.tax_category', TaxCategoryTransformer::class)

        ->set('sylius.shop_fixtures.transformer.taxon', TaxonTransformer::class)

        ->set('sylius.shop_fixtures.transformer.zone', ZoneTransformer::class)

        ->set('sylius.shop_fixtures.transformer.zone_member')
            ->parent('sylius.shop_fixtures.transformer')
    ;
};
