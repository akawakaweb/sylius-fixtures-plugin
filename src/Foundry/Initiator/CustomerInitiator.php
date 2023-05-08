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

use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class CustomerInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $customerFactory,
    ) {
    }

    public function __invoke(array $attributes): object
    {
        $customer = $this->customerFactory->createNew();
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $customer->setEmail($attributes['email'] ?? null);
        $customer->setFirstName($attributes['firstName'] ?? null);
        $customer->setLastName($attributes['lastName'] ?? null);
        $customer->setGroup($attributes['customerGroup'] ?? null);
        $customer->setGender($attributes['gender'] ?? '');
        $customer->setPhoneNumber($attributes['phoneNumber'] ?? null);
        $customer->setBirthday($attributes['birthday'] ?? null);

        return $customer;
    }
}
