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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerGroupFactory;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultCustomerGroupsStory extends Story
{
    public function build(): void
    {
        Factory::delayFlush(function () {
            CustomerGroupFactory::new()
                ->withCode('retail')
                ->withName('Retail')
                ->create()
            ;

            CustomerGroupFactory::new()
                ->withCode('wholesale')
                ->withName('Wholesale')
                ->create()
            ;
        });
    }
}
