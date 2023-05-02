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

use Sylius\Component\Locale\Model\LocaleInterface;

final class LocaleUpdater implements LocaleUpdaterInterface
{
    public function update(LocaleInterface $locale, array $attributes): void
    {
        $locale->setCode($attributes['code']);
    }
}
