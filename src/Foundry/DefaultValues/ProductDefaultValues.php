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
use Sylius\Component\Core\Model\ProductInterface;

final class ProductDefaultValues implements ProductDefaultValuesInterface
{
    public function getDefaultValues(Generator $faker): array
    {
        return [
            'name' => $faker->words(3, true),
            'averageRating' => $faker->randomFloat(),
            'createdAt' => $faker->dateTime(),
            'enabled' => $faker->boolean(),
            'variantSelectionMethod' => ProductInterface::VARIANT_SELECTION_MATCH,
        ];
    }
}
