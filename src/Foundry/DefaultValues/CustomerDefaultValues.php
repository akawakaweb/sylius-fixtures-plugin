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
use Sylius\Component\Core\Model\CustomerInterface;

final class CustomerDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'createdAt' => $faker->dateTime(),
            'firstName' => $faker->firstName(),
            'lastName' => $faker->firstName(),
            'email' => $faker->email(),
            'gender' => CustomerInterface::UNKNOWN_GENDER,
            'phoneNumber' => $faker->phoneNumber(),
            'birthday' => $faker->dateTimeBetween('-80 years', '-18 years'),
            'subscribedToNewsletter' => $faker->boolean(),
        ];
    }
}
