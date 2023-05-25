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

use Sylius\Component\Product\Generator\SlugGeneratorInterface;

trait TransformNameToSlugAttributeTrait
{
    private function transformNameToSlugAttribute(array $attributes, SlugGeneratorInterface $slugGenerator): array
    {
        /** @var string|null $slug */
        $slug = $attributes['slug'] ?? null;

        /** @var string|null $name */
        $name = $attributes['name'] ?? null;

        $attributes['slug'] = $slug ?? $slugGenerator->generate($name ?? '');

        return $attributes;
    }
}
