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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Updater;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Faker\Factory;
use Faker\Generator;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Shipping\Calculator\DefaultCalculators;
use Zenstruck\Foundry\Proxy;

final class ShippingMethodUpdater implements ShippingMethodUpdaterInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function update(ShippingMethodInterface $shippingMethod, array $attributes): void
    {
        $shippingMethod->setCode($attributes['code'] ?? null);
        $shippingMethod->setZone($attributes['zone'] ?? null);
        $shippingMethod->setTaxCategory($attributes['taxCategory'] ?? null);
        $shippingMethod->setCategory($attributes['category'] ?? null);
        $shippingMethod->setArchivedAt($attributes['archivedAt'] ?? null);
        $shippingMethod->setEnabled($attributes['enabled'] ?? true);

        /** @var Proxy<LocaleInterface> $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $shippingMethod->setCurrentLocale($localeCode);
            $shippingMethod->setFallbackLocale($localeCode);

            $shippingMethod->setName($attributes['name'] ?? null);
            $shippingMethod->setDescription($attributes['description'] ?? null);
        }

        /** @var ChannelInterface $channel */
        foreach ($attributes['channels'] ?? [] as $channel) {
            $shippingMethod->addChannel($channel);
        }

        if (null === ($attributes['calculator'] ?? null)) {
            $configuration = [];

            /** @var ChannelInterface $channel */
            foreach ($attributes['channels'] ?? [] as $channel) {
                $configuration[$channel->getCode() ?? ''] = ['amount' => $this->faker->numberBetween(100, 1000)];
            }

            $attributes['calculator'] = [
                'type' => DefaultCalculators::FLAT_RATE,
                'configuration' => $configuration,
            ];
        }

        /** @var string|null $calculator */
        $calculator = $attributes['calculator']['type'] ?? null;

        /** @var array $configuration */
        $configuration = $attributes['calculator']['configuration'] ?? [];

        $shippingMethod->setCalculator($calculator);
        $shippingMethod->setConfiguration($configuration);
    }
}
