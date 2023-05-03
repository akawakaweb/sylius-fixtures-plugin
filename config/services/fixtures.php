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

use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\RandomAddressesFixture;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\RandomCapsFixture;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\RandomDressesFixture;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\RandomJeansFixture;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\RandomShopUsersFixture;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\RandomTShirtsFixture;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\ShopConfigurationFixture;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.foundry.fixture.shop_configuration', ShopConfigurationFixture::class)
            ->tag('doctrine.fixture.orm')

        ->set('sylius.shop_fixtures.foundry.fixture.random_addresses', RandomAddressesFixture::class)
            ->tag('doctrine.fixture.orm')

        ->set('sylius.shop_fixtures.foundry.fixture.random_caps', RandomCapsFixture::class)
            ->tag('doctrine.fixture.orm')

        ->set('sylius.shop_fixtures.foundry.fixture.random_dresses', RandomDressesFixture::class)
            ->tag('doctrine.fixture.orm')

        ->set('sylius.shop_fixtures.foundry.fixture.random_jeans', RandomJeansFixture::class)
            ->tag('doctrine.fixture.orm')

        ->set('sylius.shop_fixtures.foundry.fixture.random_t_shirts', RandomTShirtsFixture::class)
            ->tag('doctrine.fixture.orm')

        ->set('sylius.shop_fixtures.foundry.fixture.random_shop_users', RandomShopUsersFixture::class)
            ->tag('doctrine.fixture.orm')
    ;
};
