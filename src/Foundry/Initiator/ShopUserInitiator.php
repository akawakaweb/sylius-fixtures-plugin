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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\UpdaterInterface;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class ShopUserInitiator implements InitiatorInterface
{
    /**
     * @param class-string $customerModelClass
     */
    public function __construct(
        private FactoryInterface $shopUserFactory,
        private InitiatorInterface $customerInitiator,
        private string $customerModelClass,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $customer = ($this->customerInitiator)($attributes, $this->customerModelClass);
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $shopUser = $this->shopUserFactory->createNew();
        Assert::isInstanceOf($shopUser, ShopUserInterface::class);

        $shopUser->setCustomer($customer);

        $shopUser->addRole('ROLE_USER');

        ($this->updater)($shopUser, $attributes);

        return $shopUser;
    }
}
