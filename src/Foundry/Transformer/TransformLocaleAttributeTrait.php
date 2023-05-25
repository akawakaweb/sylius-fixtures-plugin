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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;

trait TransformLocaleAttributeTrait
{
    private function transformLocaleAttribute(array $attributes, ?string $key): array
    {
        $key ??= 'locale';

        if (\is_string($attributes[$key] ?? null)) {
            $attributes[$key] = LocaleFactory::findOrCreate(['code' => $attributes[$key]]);
        }

        return $attributes;
    }
}
