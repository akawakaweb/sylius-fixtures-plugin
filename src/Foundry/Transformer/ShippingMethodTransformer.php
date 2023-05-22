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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShippingCategoryFactory;

final class ShippingMethodTransformer implements TransformerInterface
{
    use TransformNameToCodeAttributeTrait;
    use TransformChannelsAttributeTrait;
    use TransformZoneAttributeTrait;
    use TransformTaxCategoryAttributeTrait;

    public function transform(array $attributes): array
    {
        $attributes = $this->transformChannelsAttribute($attributes);
        $attributes = $this->transformZoneAttribute($attributes);
        $attributes = $this->transformTaxCategoryAttribute($attributes);

        if (\is_string($attributes['category'] ?? null)) {
            $attributes['category'] = ShippingCategoryFactory::findOrCreate(['code' => $attributes['category']]);
        }

        return $this->transformNameToCodeAttribute($attributes);
    }
}
