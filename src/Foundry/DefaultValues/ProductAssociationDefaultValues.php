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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAssociationTypeFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductFactory;
use Faker\Generator;
use Zenstruck\Foundry\LazyValue;

final class ProductAssociationDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'createdAt' => $faker->dateTime(),
            'owner' => new LazyValue(fn () => ProductFactory::randomOrCreate()),
            'type' => ProductAssociationTypeFactory::new(),
        ];
    }
}
