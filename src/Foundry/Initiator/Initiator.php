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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\UpdaterInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class Initiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $factory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $object = $this->factory->createNew();

        ($this->updater)($object, $attributes);

        return $object;
    }
}
