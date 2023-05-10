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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Updater;

use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

final class Updater implements UpdaterInterface
{
    private static ?PropertyAccessor $propertyAccessor = null;

    public function __invoke(object $object, array $attributes): array
    {
        foreach ($attributes as $attribute => $value) {
            try {
                self::propertyAccessor()->setValue($object, $attribute, $value);
            } catch (NoSuchPropertyException) {
            }
        }

        return $attributes;
    }

    private static function propertyAccessor(): PropertyAccessor
    {
        return self::$propertyAccessor ?? self::$propertyAccessor = PropertyAccess::createPropertyAccessor();
    }
}
