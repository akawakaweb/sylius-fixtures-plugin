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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;

trait TransformLocalesAttributeTrait
{
    private function transformLocalesAttribute(array $attributes): array
    {
        $locales = &$attributes['locales'];

        /**
         * @var int $key
         * @var mixed $locale
         */
        foreach ($locales ?? [] as $key => $locale) {
            if (\is_string($locale)) {
                $locale = LocaleFactory::findOrCreate(['code' => $locale]);
                $locales[$key] = $locale;
            }
        }

        return $attributes;
    }
}
