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
use Sylius\Component\Promotion\Checker\Rule\CartQuantityRuleChecker;

final class PromotionRuleDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'type' => CartQuantityRuleChecker::TYPE,
            'configuration' => ['count' => $faker->randomNumber(1)],
        ];
    }
}
