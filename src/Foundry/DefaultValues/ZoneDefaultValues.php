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
use Sylius\Component\Addressing\Model\ZoneInterface;

final class ZoneDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'name' => $faker->text(),
            'type' => ZoneInterface::TYPE_ZONE,
        ];
    }
}
