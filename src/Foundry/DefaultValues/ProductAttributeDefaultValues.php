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
use Sylius\Component\Attribute\AttributeType\CheckboxAttributeType;
use Sylius\Component\Attribute\AttributeType\DateAttributeType;
use Sylius\Component\Attribute\AttributeType\DatetimeAttributeType;
use Sylius\Component\Attribute\AttributeType\IntegerAttributeType;
use Sylius\Component\Attribute\AttributeType\PercentAttributeType;
use Sylius\Component\Attribute\AttributeType\SelectAttributeType;
use Sylius\Component\Attribute\AttributeType\TextareaAttributeType;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;

final class ProductAttributeDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'name' => $faker->words(3, true),
            'configuration' => [],
            'createdAt' => $faker->dateTime(),
            'translatable' => $faker->boolean(),
            'type' => $faker->randomElement([
                CheckboxAttributeType::TYPE,
                DateAttributeType::TYPE,
                DatetimeAttributeType::TYPE,
                IntegerAttributeType::TYPE,
                PercentAttributeType::TYPE,
                SelectAttributeType::TYPE,
                TextareaAttributeType::TYPE,
                TextAttributeType::TYPE,
            ]),
        ];
    }
}
