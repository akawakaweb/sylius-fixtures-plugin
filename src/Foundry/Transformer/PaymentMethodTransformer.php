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

final class PaymentMethodTransformer implements TransformerInterface
{
    use TransformNameToCodeAttributeTrait;
    use TransformChannelsAttributeTrait;

    public function transform(array $attributes): array
    {
        $attributes = $this->transformChannelsAttribute($attributes);

        return $this->transformNameToCodeAttribute($attributes);
    }
}
