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

use Sylius\Component\Core\Model\AddressInterface;

final class AddressUpdater implements AddressUpdaterInterface
{
    public function update(AddressInterface $address, array $attributes): void
    {
        $address->setFirstName($attributes['firstName'] ?? null);
        $address->setLastName($attributes['lastName'] ?? null);
        $address->setPhoneNumber($attributes['phoneNumber'] ?? null);
        $address->setCompany($attributes['company'] ?? null);
        $address->setStreet($attributes['street'] ?? null);
        $address->setCity($attributes['city'] ?? null);
        $address->setPostcode($attributes['postcode'] ?? null);
        $address->setCountryCode($attributes['countryCode'] ?? null);
        $address->setProvinceName($attributes['provinceName'] ?? null);
        $address->setProvinceCode($attributes['provinceCode'] ?? null);
        $address->setCustomer($attributes['customer'] ?? null);
    }
}
