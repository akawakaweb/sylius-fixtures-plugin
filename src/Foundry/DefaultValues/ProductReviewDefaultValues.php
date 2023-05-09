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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductFactory;
use Faker\Generator;
use Sylius\Component\Review\Model\ReviewInterface;
use Zenstruck\Foundry\LazyValue;

final class ProductReviewDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'author' => new LazyValue(fn () => CustomerFactory::randomOrCreate()),
            'createdAt' => $faker->dateTime(),
            'rating' => $faker->numberBetween(1, 5),
            'reviewSubject' => new LazyValue(fn () => ProductFactory::randomOrCreate()),
            'status' => $faker->randomElement([
                ReviewInterface::STATUS_NEW,
                ReviewInterface::STATUS_ACCEPTED,
                ReviewInterface::STATUS_REJECTED,
            ]),
        ];
    }
}
