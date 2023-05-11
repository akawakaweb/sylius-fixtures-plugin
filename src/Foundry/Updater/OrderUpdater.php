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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\AddressFactory;
use SM\Factory\FactoryInterface as StateMachineFactoryInterface;
use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\OrderCheckoutTransitions;
use Webmozart\Assert\Assert;

final class OrderUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
        private StateMachineFactoryInterface $stateMachineFactory,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        $attributes = ($this->decorated)($object, $attributes);

        if (!$object instanceof OrderInterface) {
            return $attributes;
        }

        $country = $attributes['country'] ?? null;
        Assert::nullOrIsInstanceOf($country, CountryInterface::class);

        $countryCode = $country?->getCode();

        if (null !== $countryCode) {
            $this->address($object, $countryCode);
        }

        return $attributes;
    }

    private function address(OrderInterface $order, string $countryCode): void
    {
        /** @var AddressInterface $address */
        $address = AddressFactory::new()
            ->withCountryCode($countryCode)
            ->create()
            ->object()
        ;

        $order->setShippingAddress($address);
        $order->setBillingAddress(clone $address);

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_ADDRESS);
    }

    private function applyCheckoutStateTransition(OrderInterface $order, string $transition): void
    {
        $this->stateMachineFactory->get($order, OrderCheckoutTransitions::GRAPH)->apply($transition);
    }
}
