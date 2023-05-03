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

use Sylius\Component\Addressing\Model\ZoneMemberInterface;

final class ZoneMemberUpdater implements ZoneMemberUpdaterInterface
{
    public function update(ZoneMemberInterface $zoneMember, array $attributes): void
    {
        $zoneMember->setCode($attributes['code'] ?? null);
        $zoneMember->setBelongsTo($attributes['belongsTo'] ?? null);
    }
}
