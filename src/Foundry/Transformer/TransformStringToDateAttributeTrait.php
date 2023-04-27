<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Transformer;

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
