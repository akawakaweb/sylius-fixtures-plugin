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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator;

interface InitiatorInterface
{
    /**
     * @param class-string $class
     */
    public function __invoke(array $attributes, string $class): object;
}
