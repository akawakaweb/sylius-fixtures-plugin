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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Faker\Generator;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use function Zenstruck\Foundry\lazy;
use Zenstruck\Foundry\Proxy;

final class ChannelDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'accountVerificationRequired' => $faker->boolean(),
            'baseCurrency' => lazy(function (): Proxy {
                /** @var Proxy<CurrencyInterface> $currency */
                $currency = CurrencyFactory::randomOrCreate();

                return $currency;
            }),
            'code' => $faker->text(),
            'createdAt' => $faker->dateTime(),
            'defaultLocale' => lazy(function (): Proxy {
                /** @var Proxy<LocaleInterface> $locale */
                $locale = LocaleFactory::randomOrCreate();

                return $locale;
            }),
            'enabled' => $faker->boolean(),
            'locales' => lazy(function (): array {
                return LocaleFactory::all();
            }),
            'name' => $faker->text(),
            'shippingAddressInCheckoutRequired' => $faker->boolean(),
            'skippingPaymentStepAllowed' => $faker->boolean(),
            'skippingShippingStepAllowed' => $faker->boolean(),
            'taxCalculationStrategy' => 'order_items_based',
        ];
    }
}
