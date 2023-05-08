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

use Sylius\Component\Customer\Model\CustomerGroupInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class CustomerGroupInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $customerGroupFactory,
    ) {
    }

    public function __invoke(array $attributes): object
    {
        $customerGroup = $this->customerGroupFactory->createNew();
        Assert::isInstanceOf($customerGroup, CustomerGroupInterface::class);

        $customerGroup->setCode($attributes['code'] ?? null);
        $customerGroup->setName($attributes['name'] ?? null);

        return $customerGroup;
    }
}
