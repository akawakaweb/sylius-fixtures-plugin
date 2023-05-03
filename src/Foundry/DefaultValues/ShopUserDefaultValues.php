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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues;

use Faker\Generator;

final class ShopUserDefaultValues implements ShopUserDefaultValuesInterface
{
    public function __construct(
        private CustomerDefaultValuesInterface $customerDefaultValues,
    ) {
    }

    public function getDefaultValues(Generator $faker): array
    {
        return array_merge($this->customerDefaultValues->getDefaultValues($faker), [
            'enabled' => true,
            'password' => 'password123',
        ]);
    }
}