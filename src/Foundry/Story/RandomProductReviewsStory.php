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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductReviewFactory;
use Zenstruck\Foundry\Story;

final class RandomProductReviewsStory extends Story implements RandomProductReviewsStoryInterface
{
    public function build(): void
    {
        ProductReviewFactory::createMany(40);
    }
}
