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

use Sylius\Component\Core\Formatter\StringInflector;

trait TransformNameToCodeAttributeTrait
{
    public function transformNameToCodeAttribute(array $attributes): array
    {
        /** @var string|null $code */
        $code = $attributes['code'] ?? null;

        /** @var string|null $name */
        $name = $attributes['name'] ?? null;

        if (
            null === $code &&
            \is_string($name)
        ) {
            $name = StringInflector::nameToCode($name);

            $attributes['code'] = $name;
        }

        return $attributes;
    }
}
