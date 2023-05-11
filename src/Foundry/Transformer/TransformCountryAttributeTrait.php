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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Transformer;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CountryFactory;

trait TransformCountryAttributeTrait
{
    private function transformCountryAttribute(array $attributes): array
    {
        if (\is_string($attributes['country'] ?? null)) {
            $attributes['country'] = CountryFactory::findOrCreate(['code' => $attributes['country']]);
        }

        return $attributes;
    }
}
