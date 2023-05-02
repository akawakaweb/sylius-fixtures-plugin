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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Sylius\Component\Addressing\Model\ZoneInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @mixin ModelFactory
 */
trait WithZoneTrait
{
    public function withZone(Proxy|ZoneInterface|string $zone): self
    {
        return $this->addState(['zone' => $zone]);
    }
}
