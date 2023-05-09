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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Faker\Factory;
use Faker\Generator;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Shipping\Calculator\DefaultCalculators;
use Webmozart\Assert\Assert;
use Zenstruck\Foundry\Proxy;

final class ShippingMethodInitiator implements InitiatorInterface
{
    private Generator $faker;

    public function __construct(
        private FactoryInterface $shippingMethodFactory,
    ) {
        $this->faker = Factory::create();
    }

    public function __invoke(array $attributes, string $class): object
    {
        $shippingMethod = $this->shippingMethodFactory->createNew();
        Assert::isInstanceOf($shippingMethod, ShippingMethodInterface::class);

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

        return $shippingMethod;
    }
}
