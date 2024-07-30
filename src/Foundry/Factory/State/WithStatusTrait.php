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
trait WithStatusTrait
{
    public function withStatus(string $status): self
    {
        return $this->with(['status' => $status]);
    }
}
