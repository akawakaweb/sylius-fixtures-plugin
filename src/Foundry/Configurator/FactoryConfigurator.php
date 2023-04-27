<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Configurator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\FactoryWithModelClassAwareInterface;
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

        $modelClass = $this->getModelClass($factory::getEntityClass());

        if (null === $modelClass) {
            return;
        }

        $factory::withModelClass($modelClass);
    }

    private function getModelClass(string $class): ?string
    {
        foreach ($this->registry->getAll() as $metadata) {
            $modelClass = $metadata->getClass('model');

            if (is_subclass_of($modelClass, $class)) {
                return $modelClass;
            }
        }

        return null;
    }
}
