<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues;

use Faker\Generator;

final class CurrencyDefaultValues implements CurrencyDefaultValuesInterface
{
    public function getDefaultValues(Generator $faker): array
    {
        return [
            'code' => $faker->currencyCode(),
            'createdAt' => $faker->dateTime(),
        ];
    }
}
