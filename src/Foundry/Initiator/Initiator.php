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

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Initiator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;

final class Initiator implements InitiatorInterface
{
    private bool $withoutConstructor = false;

    public function __construct(
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $object = $this->instantiate($class, $attributes);

        ($this->updater)($object, $attributes);

        return $object;
    }

    /**
     * Instantiate objects without calling the constructor.
     */
    public function withoutConstructor(): self
    {
        $this->withoutConstructor = true;

        return $this;
    }

    /**
     * Ignore attributes that can't be set to object.
     *
     * @param string[] $attributes The attributes you'd like the instantiator to ignore (if empty, ignore any extra)
     */
    public function allowExtraAttributes(array $attributes = []): self
    {
        $this->updater->allowExtraAttributes($attributes);

        return $this;
    }

    /**
     * Always force properties, never use setters (still uses constructor unless disabled).
     *
     * @param string[] $properties The properties you'd like the instantiator to "force set" (if empty, force set all)
     */
    public function alwaysForceProperties(array $properties = []): self
    {
        $this->updater->alwaysForceProperties($properties);

        return $this;
    }

    /**
     * Check if parameter value was passed as the exact name - if not, try snake-cased, then kebab-cased versions.
     */
    private static function attributeNameForParameter(\ReflectionParameter $parameter, array $attributes): ?string
    {
        // try exact
        $name = $parameter->getName();

        if (\array_key_exists($name, $attributes)) {
            return $name;
        }

        return null;
    }

    /**
     * @param class-string $class
     */
    private function instantiate(string $class, array &$attributes): object
    {
        $class = new \ReflectionClass($class);
        $constructor = $class->getConstructor();

        if ($this->withoutConstructor || !$constructor || !$constructor->isPublic()) {
            return $class->newInstanceWithoutConstructor();
        }

        $arguments = [];

        foreach ($constructor->getParameters() as $parameter) {
            $name = self::attributeNameForParameter($parameter, $attributes);

            if ($name && \array_key_exists($name, $attributes)) {
                if ($parameter->isVariadic()) {
                    $arguments = \array_merge($arguments, $attributes[$name]);
                } else {
                    $arguments[] = $attributes[$name];
                }
            } elseif ($parameter->isDefaultValueAvailable()) {
                $arguments[] = $parameter->getDefaultValue();
            } else {
                throw new \InvalidArgumentException(\sprintf('Missing constructor argument "%s" for "%s".', $parameter->getName(), $class->getName()));
            }

            // unset attribute so it isn't used when setting object properties
            unset($attributes[$name]);
        }

        return $class->newInstance(...$arguments);
    }
}
