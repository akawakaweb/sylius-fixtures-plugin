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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State;

use Sylius\Component\Core\Model\CustomerInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;

/**
 * @mixin PersistentProxyObjectFactory
 */
trait WithCustomerTrait
{
    public function withCustomer(Proxy|CustomerInterface|string $customer): self
    {
        return $this->with(['customer' => $customer]);
    }
}
