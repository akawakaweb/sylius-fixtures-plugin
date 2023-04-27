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

use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\RandomShopUsersFixture;
use Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture\ShopConfigurationFixture;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomShopUsersStory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('sylius.shop_fixtures.foundry.fixture.shop_configuration', ShopConfigurationFixture::class)
            ->tag('doctrine.fixture.orm')

        ->set('sylius.shop_fixtures.foundry.fixture.random_shop_users', RandomShopUsersFixture::class)
            ->tag('doctrine.fixture.orm')
    ;
};
