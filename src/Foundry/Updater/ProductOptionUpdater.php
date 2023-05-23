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
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Webmozart\Assert\Assert;
use Zenstruck\Foundry\Proxy;

final class ProductOptionUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        Assert::isInstanceOf($object, ProductOptionInterface::class);

        $name = $attributes['name'] ?? null;
        Assert::nullOrString($name);

        unset($attributes['name']);

        $attributes = ($this->decorated)($object, $attributes);

        /** @var Proxy<LocaleInterface> $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $object->setCurrentLocale($localeCode);
            $object->setFallbackLocale($localeCode);

            $object->setName($name);
        }

        return $attributes;
    }
}
