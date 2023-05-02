<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Configurator\FactoryConfigurator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\AddressFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CountryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\FactoryWithModelClassAwareInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShippingCategoryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShippingMethodFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShopUserFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxonFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ZoneFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ZoneMemberFactory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->instanceof(FactoryWithModelClassAwareInterface::class)
            ->configurator([service('sylius.shop_fixtures.factory.configurator'), 'configure'])

        ->set('sylius.shop_fixtures.factory.configurator', FactoryConfigurator::class)
            ->args([
                service('sylius.resource_registry'),
            ])

        ->set('sylius.shop_fixtures.factory.address', AddressFactory::class)
            ->args([
//                service('sylius.factory.address'),
//                service('sylius.shop_fixtures.default_values.address'),
//                service('sylius.shop_fixtures.transformer.address'),
//                service('sylius.shop_fixtures.updater.address'),
            ])
            ->tag('foundry.factory')
        ->alias(AddressFactory::class, 'sylius.shop_fixtures.factory.address')

        ->set('sylius.shop_fixtures.factory.channel', ChannelFactory::class)
            ->args([
//                service('sylius.factory.channel'),
//                service('sylius.shop_fixtures.default_values.channel'),
//                service('sylius.shop_fixtures.transformer.channel'),
//                service('sylius.shop_fixtures.updater.channel'),
            ])
            ->tag('foundry.factory')
        ->alias(ChannelFactory::class, 'sylius.shop_fixtures.factory.channel')

        ->set('sylius.shop_fixtures.factory.country', CountryFactory::class)
            ->args([
                service('sylius.factory.country'),
                service('sylius.shop_fixtures.default_values.country'),
                service('sylius.shop_fixtures.transformer.country'),
                service('sylius.shop_fixtures.updater.country'),
            ])
            ->tag('foundry.factory')
        ->alias(CountryFactory::class, 'sylius.shop_fixtures.factory.country')

        ->set('sylius.shop_fixtures.factory.currency', CurrencyFactory::class)
            ->args([
                service('sylius.factory.currency'),
                service('sylius.shop_fixtures.default_values.currency'),
                service('sylius.shop_fixtures.transformer.currency'),
                service('sylius.shop_fixtures.updater.currency'),
            ])
            ->tag('foundry.factory')
        ->alias(CurrencyFactory::class, 'sylius.shop_fixtures.factory.currency')

        ->set('sylius.shop_fixtures.factory.customer', CustomerFactory::class)
            ->args([
                service('sylius.factory.customer'),
                service('sylius.shop_fixtures.default_values.customer'),
                service('sylius.shop_fixtures.transformer.customer'),
                service('sylius.shop_fixtures.updater.customer'),
            ])
            ->tag('foundry.factory')
        ->alias(CustomerFactory::class, 'sylius.shop_fixtures.factory.customer')

        ->set('sylius.shop_fixtures.factory.locale', LocaleFactory::class)
            ->args([
                service('sylius.factory.locale'),
                service('sylius.shop_fixtures.default_values.locale'),
                service('sylius.shop_fixtures.transformer.locale'),
                service('sylius.shop_fixtures.updater.locale'),
            ])
            ->tag('foundry.factory')
        ->alias(LocaleFactory::class, 'sylius.shop_fixtures.factory.locale')

        ->set('sylius.shop_fixtures.factory.shipping_category', ShippingCategoryFactory::class)
            ->args([
//                service('sylius.factory.shipping_category'),
//                service('sylius.shop_fixtures.default_values.shipping_category'),
                service('sylius.shop_fixtures.transformer.shipping_category'),
//                service('sylius.shop_fixtures.updater.shipping_category'),
            ])
            ->tag('foundry.factory')
        ->alias(ShippingCategoryFactory::class, 'sylius.shop_fixtures.factory.shipping_category')

        ->set('sylius.shop_fixtures.factory.shipping_method', ShippingMethodFactory::class)
            ->args([
//                service('sylius.factory.shipping_method'),
//                service('sylius.shop_fixtures.default_values.shipping_method'),
//                service('sylius.shop_fixtures.transformer.shipping_method'),
                service('sylius.shop_fixtures.updater.shipping_method'),
            ])
            ->tag('foundry.factory')
        ->alias(ShippingMethodFactory::class, 'sylius.shop_fixtures.factory.shipping_method')

        ->set('sylius.shop_fixtures.factory.shop_user', ShopUserFactory::class)
            ->args([
                service('sylius.factory.shop_user'),
                service('sylius.factory.customer'),
                service('sylius.shop_fixtures.default_values.shop_user'),
//                service('sylius.shop_fixtures.transformer.shop_user'),
                service('sylius.shop_fixtures.updater.shop_user'),
            ])
            ->tag('foundry.factory')
        ->alias(ShopUserFactory::class, 'sylius.shop_fixtures.factory.shop_user')

        ->set('sylius.shop_fixtures.factory.taxon', TaxonFactory::class)
            ->args([
                service('sylius.factory.taxon'),
                service('sylius.repository.taxon'),
//                service('sylius.shop_fixtures.default_values.taxon'),
//                service('sylius.shop_fixtures.transformer.taxon'),
                service('sylius.shop_fixtures.updater.taxon'),
            ])
            ->tag('foundry.factory')
        ->alias(TaxonFactory::class, 'sylius.shop_fixtures.factory.taxon')


        ->set('sylius.shop_fixtures.factory.zone', ZoneFactory::class)
            ->args([
//                    service('sylius.factory.zone'),
                    service('sylius.shop_fixtures.default_values.zone'),
                    service('sylius.shop_fixtures.transformer.zone'),
//                    service('sylius.shop_fixtures.updater.zone'),
            ])
            ->tag('foundry.factory')
        ->alias(ZoneFactory::class, 'sylius.shop_fixtures.factory.zone')

        ->set('sylius.shop_fixtures.factory.zone_member', ZoneMemberFactory::class)
            ->args([
//                service('sylius.factory.zone_member'),
//                service('sylius.shop_fixtures.default_values.zone_member'),
//                service('sylius.shop_fixtures.transformer.zone_member'),
//                service('sylius.shop_fixtures.updater.zone_member'),
            ])
            ->tag('foundry.factory')
        ->alias(ZoneMemberFactory::class, 'sylius.shop_fixtures.factory.zone_member')
    ;
};
