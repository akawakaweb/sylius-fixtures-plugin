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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultCurrenciesStory extends Story implements DefaultCurrenciesStoryInterface
{
    public function build(): void
    {
        Factory::delayFlush(function () {
            foreach ($this->getCurrencyCodes() as $currencyCode) {
                CurrencyFactory::new()->withCode($currencyCode)->create();
            }
        });
    }

    /**
     * @return string[]
     */
    private function getCurrencyCodes(): array
    {
        return [
            'EUR',
            'USD',
            'PLN',
            'CAD',
            'CNY',
            'NZD',
            'GBP',
            'AUD',
            'MXN',
        ];
    }
}
