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

final class PromotionCouponDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'code' => $faker->text(),
            'createdAt' => $faker->dateTime(),
            'reusableFromCancelledOrders' => $faker->boolean(),
            'used' => 0,
        ];
    }
}
