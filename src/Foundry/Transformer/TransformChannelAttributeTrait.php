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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ChannelFactory;

trait TransformChannelAttributeTrait
{
    private function transformChannelAttribute(array $attributes): array
    {
        if (\is_string($attributes['channel'] ?? null)) {
            $attributes['channel'] = ChannelFactory::findOrCreate(['code' => $attributes['channel']]);
        }

        return $attributes;
    }
}
