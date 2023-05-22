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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\PaymentMethodFactory;
use Faker\Generator;
use Zenstruck\Foundry\LazyValue;

final class OrderDefaultValues implements DefaultValuesInterface
{
    public function __invoke(Generator $faker): array
    {
        return [
            'createdAt' => $faker->dateTime(),
            'createdByGuest' => $faker->boolean(),
            'channel' => new LazyValue(fn () => ChannelFactory::randomOrCreate()),
            'customer' => new LazyValue(fn () => CustomerFactory::randomOrCreate()),
            'completeDate' => $faker->dateTimeBetween('-1 years', 'now'),
            'fulfilled' => $faker->boolean(),
            'paymentMethod' => new LazyValue(fn () => PaymentMethodFactory::new()->enabled()->create()),
        ];
    }
}
