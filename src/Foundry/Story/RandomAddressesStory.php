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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\AddressFactory;
use Zenstruck\Foundry\Story;

final class RandomAddressesStory extends Story
{
    public function build(): void
    {
        AddressFactory::createMany(10);
    }
}