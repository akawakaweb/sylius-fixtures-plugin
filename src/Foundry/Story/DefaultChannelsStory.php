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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ChannelFactory;
use Zenstruck\Foundry\Story;

final class DefaultChannelsStory extends Story implements DefaultChannelsStoryInterface
{
    public function __construct(
        private string $basedLocaleCode,
        private string $fixturesHostname,
        private ?string $fixturesThemeName,
    ) {
    }

    public function build(): void
    {
        ChannelFactory::new()
            ->withName('Fashion Web Store')
            ->withCode('FASHION_WEB')
            ->withBaseLocale($this->basedLocaleCode)
            ->withAttributes(['baseCurrency' => 'USD'])
            ->withCurrencies(['USD'])
            ->enabled()
            ->withHostname($this->fixturesHostname)
            ->withThemeName($this->fixturesThemeName)
//            ->withShopBillingData([
//                'company' => 'Sylius',
//                'tax_id' => '0001112222',
//                'country_code' => 'US',
//                'street' => 'Test St. 15',
//                'city' => 'eCommerce Town',
//                'postcode' => '00 33 22',
//            ])
            ->withMenuTaxon('MENU_CATEGORY')
            ->withContactPhoneNumber('+41 123 456 789')
            ->withContactEmail('contact@example.com')
            ->create()
        ;
    }
}
