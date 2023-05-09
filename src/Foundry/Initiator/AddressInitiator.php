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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Initiator;

use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class AddressInitiator implements InitiatorInterface
{
    public function __construct(private FactoryInterface $addressFactory)
    {
    }

    public function __invoke(array $attributes, string $class): AddressInterface
    {
        $address = $this->addressFactory->createNew();
        Assert::isInstanceOf($address, AddressInterface::class);

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

        return $address;
    }
}
