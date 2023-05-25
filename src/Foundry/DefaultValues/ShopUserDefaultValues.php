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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues;

use Faker\Generator;

final class ShopUserDefaultValues implements DefaultValuesInterface
{
    public function __construct(
        private DefaultValuesInterface $customerDefaultValues,
    ) {
    }

    public function __invoke(Generator $faker): array
    {
        return array_merge($this->customerDefaultValues->__invoke($faker), [
            'enabled' => true,
            'password' => 'password123',
        ]);
    }
}
