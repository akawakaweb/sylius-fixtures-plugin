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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\AddressFactory;
use Zenstruck\Foundry\Story;

final class RandomAddressesStory extends Story implements RandomAddressesStoryInterface
{
    public function build(): void
    {
        AddressFactory::createMany(10);
    }
}
