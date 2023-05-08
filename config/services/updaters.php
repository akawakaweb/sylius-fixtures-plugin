<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShippingMethodInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShippingCategoryUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShippingMethodUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\TaxonUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\TaxonUpdaterInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ZoneMemberUpdater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ZoneMemberUpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.updater.taxon', TaxonUpdater::class)
            ->args([
                service('sylius.generator.taxon_slug'),
            ])
        ->alias(TaxonUpdaterInterface::class, 'sylius.shop_fixtures.updater.taxon')

        ->set('sylius.shop_fixtures.updater.zone_member', ZoneMemberUpdater::class)
        ->alias(ZoneMemberUpdaterInterface::class, 'sylius.shop_fixtures.updater.zone_member')
    ;
};
