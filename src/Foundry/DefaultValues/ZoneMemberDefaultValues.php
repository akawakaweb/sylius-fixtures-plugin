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

final class ZoneMemberDefaultValues implements ZoneMemberDefaultValuesInterface
{
    public function getDefaultValues(Generator $faker): array
    {
        return [
            'code' => $faker->unique()->word(),
        ];
    }
}