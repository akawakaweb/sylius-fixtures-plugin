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
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Webmozart\Assert\Assert;
use Zenstruck\Foundry\Proxy;

final class ProductAttributeUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        if (!$object instanceof ProductAttributeInterface) {
            return ($this->decorated)($object, $attributes);
        }

        /** @var Proxy<LocaleInterface> $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $object->setCurrentLocale($localeCode);
            $object->setFallbackLocale($localeCode);

            $name = $attributes['name'] ?? null;
            Assert::nullOrString($name);

            $object->setName($name);
        }

        unset($attributes['type'], $attributes['name']);

        return ($this->decorated)($object, $attributes);
    }
}
