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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait ToggableTrait
{
    public function enabled(): self
    {
        return $this->addState(['enabled' => true]);
    }

    public function disabled(): self
    {
        return $this->addState(['enabled' => false]);
    }
}