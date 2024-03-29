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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues;

use Faker\Generator;

final class AddressDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
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
