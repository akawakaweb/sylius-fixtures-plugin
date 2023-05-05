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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CountryFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ZoneFactory;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultGeographicalStory extends Story implements DefaultGeographicalStoryInterface
{
    public function build(): void
    {
        $countryCodes = $this->getCountryCodes();

        Factory::delayFlush(function () use ($countryCodes) {
            foreach ($countryCodes as $countryCode) {
                CountryFactory::new()->withCode($countryCode)->create();
            }
        });

        ZoneFactory::new()
            ->withName('United States of America')
            ->withCountries(['US'])
            ->create()
        ;

        \array_shift($countryCodes);

        ZoneFactory::new()
            ->withName('Rest of the World')
            ->withCountries($countryCodes)
            ->create()
        ;
    }

    /**
     * @return string[]
     */
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
