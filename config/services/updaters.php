<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ZoneMemberUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ZoneMemberUpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.updater.zone_member', ZoneMemberUpdater::class)
        ->alias(ZoneMemberUpdaterInterface::class, 'sylius.shop_fixtures.updater.zone_member')
    ;
};
