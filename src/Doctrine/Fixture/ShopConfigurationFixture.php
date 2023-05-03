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

namespace Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture;

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultAdminUsersStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultChannelsStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultCurrenciesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultCustomerGroupsStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultGeographicalStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultLocalesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultMenuTaxonStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultShippingMethodsStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultShopUsersStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ShopConfigurationFixture extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        DefaultLocalesStory::load();
        DefaultCurrenciesStory::load();
        DefaultGeographicalStory::load();
        DefaultMenuTaxonStory::load();
        DefaultChannelsStory::load();
        DefaultAdminUsersStory::load();
        DefaultShippingMethodsStory::load();
        DefaultCustomerGroupsStory::load();
        DefaultShopUsersStory::load();
    }

    public static function getGroups(): array
    {
        return ['shop_configuration'];
    }

    public function getOrder(): int
    {
        return 1;
    }
}
