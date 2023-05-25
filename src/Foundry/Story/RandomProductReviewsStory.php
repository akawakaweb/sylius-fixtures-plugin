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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductReviewFactory;
use Zenstruck\Foundry\Story;

final class RandomProductReviewsStory extends Story implements RandomProductReviewsStoryInterface
{
    public function build(): void
    {
        ProductReviewFactory::createMany(40);
    }
}
