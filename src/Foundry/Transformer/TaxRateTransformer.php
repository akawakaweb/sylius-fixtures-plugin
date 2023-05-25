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

final class TaxRateTransformer implements TransformerInterface
{
    use TransformNameToCodeAttributeTrait;
    use TransformZoneAttributeTrait;
    use TransformTaxCategoryAttributeTrait;

    public function transform(array $attributes): array
    {
        $attributes = $this->transformZoneAttribute($attributes);
        $attributes = $this->transformTaxCategoryAttribute($attributes, 'category');

        return $this->transformNameToCodeAttribute($attributes);
    }
}
