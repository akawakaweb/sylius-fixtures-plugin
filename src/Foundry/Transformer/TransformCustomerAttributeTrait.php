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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CustomerFactory;

trait TransformCustomerAttributeTrait
{
    private function transformCustomerAttribute(array $attributes, string $attributeKey = 'customer'): array
    {
        if (\is_string($attributes[$attributeKey] ?? null)) {
            $attributes[$attributeKey] = CustomerFactory::findOrCreate(['email' => $attributes[$attributeKey]]);
        }

        return $attributes;
    }
}
