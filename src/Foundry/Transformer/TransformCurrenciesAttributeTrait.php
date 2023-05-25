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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CurrencyFactory;

trait TransformCurrenciesAttributeTrait
{
    private function transformCurrenciesAttribute(array $attributes): array
    {
        $currencies = &$attributes['currencies'];

        /**
         * @var int $key
         * @var mixed $currency
         */
        foreach ($currencies ?? [] as $key => $currency) {
            if (\is_string($currency)) {
                $currency = CurrencyFactory::findOrCreate(['code' => $currency]);
                $currencies[$key] = $currency;
            }
        }

        return $attributes;
    }
}
