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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ZoneFactory;
use Faker\Generator;
use Sylius\Component\Addressing\Model\ZoneInterface;
use function Zenstruck\Foundry\lazy;
use Zenstruck\Foundry\Proxy;

final class ShippingMethodDefaultValues implements ShippingMethodDefaultValuesInterface
{
    public function getDefaultValues(Generator $faker): array
    {
        return [
            'categoryRequirement' => $faker->randomNumber(),
            'code' => $faker->text(),
            'name' => $faker->words(3, true),
            'createdAt' => $faker->dateTime(),
            'enabled' => $faker->boolean(),
            'zone' => lazy(function (): Proxy {
                /** @var Proxy<ZoneInterface> $zone */
                $zone = ZoneFactory::randomOrCreate();

                return $zone;
            }),
        ];
    }
}
