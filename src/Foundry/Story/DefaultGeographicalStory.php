<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CountryFactory;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultGeographicalStory extends Story
{
    public function build(): void
    {
        Factory::delayFlush(function () {
            foreach ($this->getCountryCodes() as $countryCode) {
                CountryFactory::new()->withCode($countryCode)->create();
            }
        });
    }

    private function getCountryCodes(): array
    {
        return [
            'US',
            'FR',
            'DE',
            'AU',
            'CA',
            'MX',
            'NZ',
            'PT',
            'ES',
            'CN',
            'GB',
            'PL',
        ];
    }
}
