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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneFactory;
use Faker\Generator;

final class ShippingMethodDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'categoryRequirement' => $faker->randomNumber(),
            'name' => $faker->words(3, true),
            'createdAt' => $faker->dateTime(),
            'enabled' => $faker->boolean(),
            'zone' => ZoneFactory::new(),
        ];
    }
}
