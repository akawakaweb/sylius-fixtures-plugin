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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxCategoryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ZoneFactory;
use Faker\Generator;
use Zenstruck\Foundry\LazyValue;

final class TaxRateDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'amount' => $faker->randomFloat(2, 0, 0.4),
            'calculator' => 'default',
            'category' => TaxCategoryFactory::new(),
            'createdAt' => $faker->dateTime(),
            'includedInPrice' => $faker->boolean(),
            'name' => $faker->text(),
            'zone' => new LazyValue(fn () => ZoneFactory::randomOrCreate()),
        ];
    }
}
