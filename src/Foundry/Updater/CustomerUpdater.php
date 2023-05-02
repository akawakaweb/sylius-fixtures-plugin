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

use Sylius\Component\Core\Model\CustomerInterface;

final class CustomerUpdater implements CustomerUpdaterInterface
{
    public function update(CustomerInterface $customer, array $attributes): void
    {
        $customer->setEmail($attributes['email'] ?? null);
        $customer->setFirstName($attributes['firstName'] ?? null);
        $customer->setLastName($attributes['lastName'] ?? null);
        $customer->setGroup($attributes['customerGroup'] ?? null);
        $customer->setGender($attributes['gender'] ?? '');
        $customer->setPhoneNumber($attributes['phoneNumber'] ?? null);
        $customer->setBirthday($attributes['birthday'] ?? null);
    }
}
