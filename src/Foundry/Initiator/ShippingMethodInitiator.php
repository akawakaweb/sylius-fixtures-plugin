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
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;
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
        private UpdaterInterface $updater,
    ) {
        $this->faker = Factory::create();
    }

    public function __invoke(array $attributes, string $class): object
    {
        $shippingMethod = $this->shippingMethodFactory->createNew();
        Assert::isInstanceOf($shippingMethod, ShippingMethodInterface::class);

        /** @var Proxy<LocaleInterface> $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $shippingMethod->setCurrentLocale($localeCode);
            $shippingMethod->setFallbackLocale($localeCode);

            $name = $attributes['name'] ?? null;
            Assert::nullOrString($name);

            $description = $attributes['description'] ?? null;
            Assert::nullOrString($description);

            $shippingMethod->setName($name);
            $shippingMethod->setDescription($description);
        }

        if (!array_key_exists('calculator', $attributes)) {
            $configuration = [];

            /** @var ChannelInterface $channel */
            foreach ($attributes['channels'] ?? [] as $channel) {
                $configuration[$channel->getCode() ?? ''] = ['amount' => $this->faker->numberBetween(100, 1000)];
            }

            $shippingMethod->setCalculator(DefaultCalculators::FLAT_RATE);
            $shippingMethod->setConfiguration($configuration);
        }

        ($this->updater)($shippingMethod, $attributes);

        return $shippingMethod;
    }
}
