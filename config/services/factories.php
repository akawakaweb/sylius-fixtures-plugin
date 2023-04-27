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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CountryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\FactoryWithModelClassAwareInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->instanceof(FactoryWithModelClassAwareInterface::class)
            ->configurator([service('sylius.shop_fixtures.factory.configurator'), 'configure'])

        ->set('sylius.shop_fixtures.factory.configurator', FactoryConfigurator::class)
            ->args([
                service('sylius.resource_registry'),
            ])

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
    ;
};
