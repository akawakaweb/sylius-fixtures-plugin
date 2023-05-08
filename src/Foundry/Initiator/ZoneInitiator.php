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

use Sylius\Component\Addressing\Model\Scope;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Addressing\Model\ZoneMemberInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class ZoneInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $zoneFactory,
    ) {
    }

    public function __invoke(array $attributes): object
    {
        $zone = $this->zoneFactory->createNew();
        Assert::isInstanceOf($zone, ZoneInterface::class);

        $zone->setCode($attributes['code'] ?? null);
        $zone->setName($attributes['name'] ?? null);
        $zone->setType($attributes['type'] ?? null);
        $zone->setScope($attributes['scope'] ?? Scope::ALL);

        /** @var ZoneMemberInterface $member */
        foreach ($attributes['members'] ?? [] as $member) {
            $zone->addMember($member);
        }

        return $zone;
    }
}
