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
use Sylius\Component\Addressing\Model\ZoneInterface;

final class ZoneDefaultValues implements ZoneDefaultValuesInterface
{
    public function getDefaultValues(Generator $faker): array
    {
        return [
            'name' => $faker->text(),
            'type' => ZoneInterface::TYPE_ZONE,
        ];
    }
}
