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

trait TransformStringToDateAttributeTrait
{
    public function transformStringToDateAttribute(array $attributes, string $key): array
    {
        $date = $attributes[$key] ?? null;

        if (!\is_string($date)) {
            return $attributes;
        }

        $attributes[$key] = new \DateTimeImmutable($date);

        return $attributes;
    }
}
