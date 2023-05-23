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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductOptionValueFactory;

final class ProductOptionTransformer implements TransformerInterface
{
    use TransformNameToCodeAttributeTrait;

    public function transform(array $attributes): array
    {
        $attributes = $this->transformNameToCodeAttribute($attributes);

        return $this->transformValuesAttribute($attributes);
    }

    private function transformValuesAttribute(array $attributes): array
    {
        $values = &$attributes['values'];

        /**
         * @var string $code
         * @var mixed $value
         */
        foreach ($values ?? [] as $code => $value) {
            if (\is_string($value)) {
                $productOptionValue = ProductOptionValueFactory::new()
                   ->withCode($code)
                    ->withValue($value)
                    ->withoutPersisting()
                    ->create()
                ;

                $values[$code] = $productOptionValue;
            }
        }

        return $attributes;
    }
}
