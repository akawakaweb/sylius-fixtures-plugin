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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\OrderFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductFactory;
use Faker\Generator;
use Zenstruck\Foundry\LazyValue;

final class OrderItemDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'immutable' => $faker->boolean(),
            'order' => OrderFactory::new(),
            'quantity' => $faker->numberBetween(1, 5),
            'variant' => new LazyValue(fn (): mixed => ProductFactory::randomOrCreate()->getVariants()->first()),
        ];
    }
}
