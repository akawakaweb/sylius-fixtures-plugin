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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Updater;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Faker\Factory;
use Faker\Generator;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Shipping\Calculator\DefaultCalculators;
use Webmozart\Assert\Assert;
use Zenstruck\Foundry\Proxy;

final class ShippingMethodUpdater implements UpdaterInterface
{
    private Generator $faker;

    public function __construct(
        private UpdaterInterface $decorated,
    ) {
        $this->faker = Factory::create();
    }

    public function __invoke(object $object, array $attributes): array
    {
        if (!$object instanceof ShippingMethodInterface) {
            return ($this->decorated)($object, $attributes);
        }

        /** @var Proxy<LocaleInterface> $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $object->setCurrentLocale($localeCode);
            $object->setFallbackLocale($localeCode);

            $name = $attributes['name'] ?? null;
            Assert::nullOrString($name);

            $description = $attributes['description'] ?? null;
            Assert::nullOrString($description);

            $object->setName($name);
            $object->setDescription($description);
        }

        unset($attributes['name'], $attributes['description']);

        if (!array_key_exists('calculator', $attributes)) {
            $configuration = [];

            /** @var ChannelInterface $channel */
            foreach ($attributes['channels'] ?? [] as $channel) {
                $configuration[$channel->getCode() ?? ''] = ['amount' => $this->faker->numberBetween(100, 1000)];
            }

            $object->setCalculator(DefaultCalculators::FLAT_RATE);
            $object->setConfiguration($configuration);
        }

        return ($this->decorated)($object, $attributes);
    }
}
