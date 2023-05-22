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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CurrencyFactory;

trait TransformCurrencyAttributeTrait
{
    private function transformCurrencyAttribute(array $attributes, ?string $key = null): array
    {
        $key ??= 'currency';

        if (\is_string($attributes[$key] ?? null)) {
            $attributes[$key] = CurrencyFactory::findOrCreate(['code' => $attributes[$key]]);
        }

        return $attributes;
    }
}
