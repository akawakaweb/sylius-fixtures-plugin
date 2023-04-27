<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues;

use Faker\Generator;

final class CountryDefaultValues implements CountryDefaultValuesInterface
{
    public function getDefaultValues(Generator $faker): array
    {
        return [
            'code' => $faker->countryCode,
            'enabled' => $faker->boolean(),
        ];
    }
}
