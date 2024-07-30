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
trait TranslatableTrait
{
    public function translatable(): self
    {
        return $this->with(['translatable' => true]);
    }

    public function untranslatable(): self
    {
        return $this->with(['translatable' => false]);
    }
}
