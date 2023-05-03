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

use Sylius\Component\Product\Generator\SlugGeneratorInterface;

final class ProductTransformer implements ProductTransformerInterface
{
    use TransformTaxonAttributeTrait;
    use TransformChannelsAttributeTrait;
    use TransformNameToCodeAttributeTrait;
    use TransformNameToSlugAttributeTrait;

    public function __construct(private SlugGeneratorInterface $slugGenerator)
    {
    }

    public function transform(array $attributes): array
    {
        $attributes = $this->transformTaxonAttribute($attributes, 'mainTaxon');
        $attributes = $this->transformChannelsAttribute($attributes);
        $attributes = $this->transformNameToCodeAttribute($attributes);

        return $this->transformNameToSlugAttribute($attributes, $this->slugGenerator);
    }
}
