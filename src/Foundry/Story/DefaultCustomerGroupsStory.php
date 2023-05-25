<?php

/*
 * This file is part of SyliusFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CustomerGroupFactory;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultCustomerGroupsStory extends Story implements DefaultCustomerGroupsStoryInterface
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
