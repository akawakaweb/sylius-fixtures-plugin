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

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithCodeTrait
{
    public function withCode(string $code): self
    {
        return $this->addState(['code' => $code]);
    }

    public function withValue(string $value): self
    {
        return $this->addState(['value' => $value]);
    }
}
