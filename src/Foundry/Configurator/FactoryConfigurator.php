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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Configurator;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\FactoryWithModelClassAwareInterface;
use Sylius\Component\Resource\Metadata\MetadataInterface;
use Sylius\Component\Resource\Metadata\RegistryInterface;
use Zenstruck\Foundry\ModelFactory;

final class FactoryConfigurator
{
    private RegistryInterface $registry;

    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function configure(FactoryWithModelClassAwareInterface $factory): void
    {
        if (!$factory instanceof ModelFactory) {
            return;
        }

        /** @var class-string|null $modelClass */
        $modelClass = $this->getModelClass($factory::getEntityClass());

        if (null === $modelClass) {
            return;
        }

        $factory::withModelClass($modelClass);
    }

    /**
     * @param class-string $class
     */
    private function getModelClass(string $class): ?string
    {
        /** @var MetadataInterface $metadata */
        foreach ($this->registry->getAll() as $metadata) {
            $modelClass = $metadata->getClass('model');

            if (is_subclass_of($modelClass, $class)) {
                return $modelClass;
            }
        }

        return null;
    }
}
