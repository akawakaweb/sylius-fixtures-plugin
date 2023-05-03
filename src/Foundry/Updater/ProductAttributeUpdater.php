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
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Zenstruck\Foundry\Proxy;

final class ProductAttributeUpdater implements ProductAttributeUpdaterInterface
{
    public function update(ProductAttributeInterface $productAttribute, array $attributes): void
    {
        $productAttribute->setCode($attributes['code'] ?? null);
        $productAttribute->setTranslatable($attributes['translatable'] ?? false);

        /** @var Proxy<LocaleInterface> $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $productAttribute->setCurrentLocale($localeCode);
            $productAttribute->setFallbackLocale($localeCode);

            $productAttribute->setName($attributes['name'] ?? null);
        }

        $productAttribute->setConfiguration($attributes['configuration'] ?? []);
    }
}
