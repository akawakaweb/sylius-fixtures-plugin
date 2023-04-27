<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Transformer;

final class CustomerTransformer implements CustomerTransformerInterface
{
    use TransformStringToDateAttributeTrait;

    public function transform(array $attributes): array
    {
        return $this->transformStringToDateAttribute($attributes, 'birthday');
    }
}
