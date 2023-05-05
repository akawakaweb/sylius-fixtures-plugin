<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AddressInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AddressInitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AdminUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AdminUserInitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ChannelInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ChannelInitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CountryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CountryInitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CurrencyInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CurrencyInitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerInitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShopUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShopUserInitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneInitiatorInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.initiator.address', AddressInitiator::class)
            ->args([
                service('sylius.factory.address'),
            ])
        ->alias(AddressInitiatorInterface::class, 'sylius.shop_fixtures.initiator.address')

        ->set('sylius.shop_fixtures.initiator.admin_user', AdminUserInitiator::class)
            ->args([
                service('sylius.factory.admin_user'),
                service('sylius.factory.avatar_image'),
                service('file_locator'),
                service('sylius.image_uploader'),
            ])
        ->alias(AdminUserInitiatorInterface::class, 'sylius.shop_fixtures.initiator.admin_user')

        ->set('sylius.shop_fixtures.initiator.channel', ChannelInitiator::class)
            ->args([
                service('sylius.factory.channel'),
            ])
        ->alias(ChannelInitiatorInterface::class, 'sylius.shop_fixtures.initiator.channel')

        ->set('sylius.shop_fixtures.initiator.country', CountryInitiator::class)
            ->args([
                service('sylius.factory.country'),
            ])
        ->alias(CountryInitiatorInterface::class, 'sylius.shop_fixtures.initiator.country')

        ->set('sylius.shop_fixtures.initiator.currency', CurrencyInitiator::class)
            ->args([
                service('sylius.factory.currency'),
            ])
        ->alias(CurrencyInitiatorInterface::class, 'sylius.shop_fixtures.initiator.currency')

        ->set('sylius.shop_fixtures.initiator.customer', CustomerInitiator::class)
            ->args([
                service('sylius.factory.customer'),
            ])
        ->alias(CustomerInitiatorInterface::class, 'sylius.shop_fixtures.initiator.customer')

        ->set('sylius.shop_fixtures.initiator.shop_user', ShopUserInitiator::class)
            ->args([
                service('sylius.factory.shop_user'),
                service('sylius.shop_fixtures.initiator.customer'),
            ])
        ->alias(ShopUserInitiatorInterface::class, 'sylius.shop_fixtures.initiator.shop_user')

        ->set('sylius.shop_fixtures.initiator.zone', ZoneInitiator::class)
            ->args([
                service('sylius.factory.zone'),
            ])
        ->alias(ZoneInitiatorInterface::class, 'sylius.shop_fixtures.initiator.zone')
    ;
};
