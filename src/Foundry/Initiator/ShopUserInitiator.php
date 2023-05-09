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
use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class ShopUserInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $shopUserFactory,
        private InitiatorInterface $customerInitiator,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $customer = ($this->customerInitiator)($attributes, $class);
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $shopUser = $this->shopUserFactory->createNew();
        Assert::isInstanceOf($shopUser, ShopUserInterface::class);

        $shopUser->setCustomer($customer);
        $shopUser->setPlainPassword($attributes['password']);
        $shopUser->setEnabled($attributes['enabled']);
        $shopUser->addRole('ROLE_USER');

        return $shopUser;
    }
}
