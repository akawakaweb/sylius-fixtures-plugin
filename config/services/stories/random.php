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

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomAddressesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomAddressesStoryInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomCapsStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomCapsStoryInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomDressesStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomDressesStoryInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomJeansStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomJeansStoryInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomShopUsersStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomShopUsersStoryInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomTShirtsStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomTShirtsStoryInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.story.random_addresses', RandomAddressesStory::class)
            ->tag('foundry.story')
        ->alias(RandomAddressesStoryInterface::class, 'sylius.shop_fixtures.foundry.story.random_addresses')

        ->set('sylius.shop_fixtures.story.random_caps', RandomCapsStory::class)
            ->tag('foundry.story')
        ->alias(RandomCapsStoryInterface::class, 'sylius.shop_fixtures.foundry.story.random_caps')

        ->set('sylius.shop_fixtures.story.random_dresses', RandomDressesStory::class)
            ->tag('foundry.story')
        ->alias(RandomDressesStoryInterface::class, 'sylius.shop_fixtures.foundry.story.random_dresses')

        ->set('sylius.shop_fixtures.story.random_jeans', RandomJeansStory::class)
            ->tag('foundry.story')
        ->alias(RandomJeansStoryInterface::class, 'sylius.shop_fixtures.foundry.story.random_jeans')

        ->set('sylius.shop_fixtures.story.random_t_shirts', RandomTShirtsStory::class)
            ->tag('foundry.story')
        ->alias(RandomTShirtsStoryInterface::class, 'sylius.shop_fixtures.foundry.story.random_t_shirts')

        ->set('sylius.shop_fixtures.story.random_shop_users', RandomShopUsersStory::class)
            ->tag('foundry.story')
        ->alias(RandomShopUsersStoryInterface::class, 'sylius.shop_fixtures.foundry.story.random_shop_users')
    ;
};
