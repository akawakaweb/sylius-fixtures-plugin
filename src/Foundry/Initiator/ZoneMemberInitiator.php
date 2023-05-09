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

use Sylius\Component\Addressing\Model\ZoneMemberInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class ZoneMemberInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $zoneMemberFactory,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $zoneMember = $this->zoneMemberFactory->createNew();
        Assert::isInstanceOf($zoneMember, ZoneMemberInterface::class);

        $zoneMember->setCode($attributes['code'] ?? null);
        $zoneMember->setBelongsTo($attributes['belongsTo'] ?? null);

        return $zoneMember;
    }
}
