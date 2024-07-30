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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State;

use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @mixin PersistentProxyObjectFactory
 */
trait ToggableTrait
{
    public function enabled(): self
    {
        return $this->with(['enabled' => true]);
    }

    public function disabled(): self
    {
        return $this->with(['enabled' => false]);
    }
}
