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

final class PaymentMethodDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'name' => $faker->words(3, true),
            'createdAt' => $faker->dateTime(),
            'enabled' => $faker->boolean(),
            'position' => $faker->randomNumber(),
            'gatewayName' => 'Offline',
            'gatewayFactory' => 'offline',
        ];
    }
}
