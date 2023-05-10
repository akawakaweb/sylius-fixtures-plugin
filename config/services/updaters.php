<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AddressInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\AdminUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CatalogPromotionActionInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CatalogPromotionInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CatalogPromotionScopeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ChannelInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CountryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CurrencyInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerGroupInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\CustomerInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\Initiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\LocaleInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAssociationInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAssociationTypeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductAttributeInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ProductReviewInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\PromotionRuleInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShippingCategoryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShippingMethodInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ShopUserInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\TaxCategoryInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\TaxonInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\ZoneMemberInitiator;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\Updater;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.updater', Updater::class)
            ->call('allowExtraAttributes')
        ->alias(UpdaterInterface::class, 'sylius.shop_fixtures.updater')
    ;
};
