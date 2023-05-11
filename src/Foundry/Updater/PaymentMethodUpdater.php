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
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Webmozart\Assert\Assert;

final class PaymentMethodUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        if (!$object instanceof PaymentMethodInterface) {
            return ($this->decorated)($object, $attributes);
        }

        $object->getGatewayConfig()->setConfig($attributes['gatewayConfig'] ?? []);
        $object->getGatewayConfig()->setGatewayName($attributes['gatewayName']);

        /** @var LocaleInterface $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $object->setCurrentLocale($localeCode);
            $object->setFallbackLocale($localeCode);

            $name = $attributes['name'] ?? null;
            Assert::nullOrString($name);

            $description = $attributes['description'] ?? null;
            Assert::nullOrString($description);

            $instructions = $attributes['instructions'] ?? null;
            Assert::nullOrString($instructions);

            $object->setName($name);
            $object->setDescription($description);
            $object->setInstructions($instructions);
        }

        unset(
            $attributes['gatewayConfig'],
            $attributes['gatewayName'],
            $attributes['name'],
            $attributes['description'],
            $attributes['instructions'],
        );

        return ($this->decorated)($object, $attributes);
    }
}
