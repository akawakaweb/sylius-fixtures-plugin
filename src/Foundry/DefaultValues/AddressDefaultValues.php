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

use Faker\Generator;

final class AddressDefaultValues implements AddressDefaultValuesInterface
{
    public function getDefaultValues(Generator $faker): array
    {
        return [
            'city' => $faker->city(),
            'countryCode' => $faker->text(),
            'createdAt' => $faker->dateTime(),
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
            'postcode' => $faker->postcode(),
            'street' => $faker->streetAddress(),
        ];
    }
}
