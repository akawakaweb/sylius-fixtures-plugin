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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Initiator;

use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class ChannelInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $channelFactory,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        /** @var ChannelInterface $channel */
        $channel = $this->channelFactory->createNew();

        $channel->setCode($attributes['code'] ?? null);
        $channel->setName($attributes['name'] ?? null);
        $channel->setHostname($attributes['hostname'] ?? null);
        $channel->setEnabled($attributes['enabled'] ?? true);
        $channel->setColor($attributes['color'] ?? null);
        $channel->setDefaultTaxZone($attributes['defaultTaxZone'] ?? null);
        $channel->setTaxCalculationStrategy($attributes['taxCalculationStrategy'] ?? null);
        $channel->setThemeName($attributes['themeName'] ?? null);
        $channel->setContactEmail($attributes['contactEmail'] ?? null);
        $channel->setContactPhoneNumber($attributes['contactPhoneNumber'] ?? null);
        $channel->setSkippingShippingStepAllowed($attributes['skippingShippingStepAllowed'] ?? false);
        $channel->setSkippingPaymentStepAllowed($attributes['skippingPaymentStepAllowed'] ?? false);
        $channel->setAccountVerificationRequired($attributes['accountVerificationRequired'] ?? true);
        $channel->setMenuTaxon($attributes['menuTaxon'] ?? null);

        $channel->setDefaultLocale($attributes['defaultLocale'] ?? null);

        /** @var LocaleInterface $locale */
        foreach ($attributes['locales'] ?? [] as $locale) {
            $channel->addLocale($locale);
        }

        // Ensure Default locale is on available locale
        $channel->addLocale($attributes['defaultLocale']);

        $channel->setBaseCurrency($attributes['baseCurrency']);

        /** @var CurrencyInterface $currency */
        foreach ($attributes['currencies'] ?? [] as $currency) {
            $channel->addCurrency($currency);
        }

        if (null !== ($attributes['shopBillingData'] ?? null)) {
            $channel->setShopBillingData($attributes['shopBillingData']);
        }

        return $channel;
    }
}
