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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State;

use Sylius\Component\Core\Model\CustomerInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @mixin ModelFactory
 */
trait WithCustomerTrait
{
    public function withCustomer(Proxy|CustomerInterface|string $customer): self
    {
        return $this->addState(['customer' => $customer]);
    }
}
