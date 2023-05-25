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
use Sylius\Component\Core\Promotion\Action\PercentageDiscountPromotionActionCommand;

final class PromotionActionDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'type' => PercentageDiscountPromotionActionCommand::TYPE,
            'configuration' => ['percentage' => $faker->randomNumber(2)],
        ];
    }
}
