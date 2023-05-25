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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\OrderFactory;
use Zenstruck\Foundry\Story;

final class RandomOrdersStory extends Story implements RandomOrdersStoryInterface
{
    public function build(): void
    {
        OrderFactory::createMany(20);
    }
}
