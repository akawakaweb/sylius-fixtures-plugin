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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\OrderSequenceFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShippingMethodFactory;
use Faker\Factory;
use Faker\Generator;
use SM\Factory\FactoryInterface as StateMachineFactoryInterface;
use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Core\OrderCheckoutStates;
use Sylius\Component\Core\OrderCheckoutTransitions;
use Sylius\Component\Core\Repository\PaymentMethodRepositoryInterface;
use Sylius\Component\Core\Repository\ShippingMethodRepositoryInterface;
use Webmozart\Assert\Assert;
use Zenstruck\Foundry\Proxy;

final class OrderUpdater implements UpdaterInterface
{
    private Generator $faker;

    public function __construct(
        private UpdaterInterface $decorated,
        private StateMachineFactoryInterface $stateMachineFactory,
        private ShippingMethodRepositoryInterface $shippingMethodRepository,
        private PaymentMethodRepositoryInterface $paymentMethodRepository,
    ) {
        $this->faker = Factory::create();
    }

    public function __invoke(object $object, array $attributes): array
    {
        // Ensure the order number sequence is stored in the database.
        if (0 === OrderSequenceFactory::count()) {
            OrderSequenceFactory::createOne();
        }

        $attributes = ($this->decorated)($object, $attributes);

        if (!$object instanceof OrderInterface) {
            return $attributes;
        }

        $country = $attributes['country'] ?? null;
        Assert::nullOrIsInstanceOf($country, CountryInterface::class);

        $countryCode = $country?->getCode() ?? 'US';

        /** @var \DateTimeInterface $createdAt */
        $createdAt = $attributes['completeDate'] ?? new \DateTimeImmutable();

        $this->address($object, $countryCode);
        $this->selectShipping($object, $createdAt);
        $this->selectPayment($object, $createdAt);
        $this->completeCheckout($object);

        return $attributes;
    }

    private function address(OrderInterface $order, string $countryCode): void
    {
        /** @var Proxy<AddressInterface> $address */
        $address = AddressFactory::new()
            ->withCountryCode($countryCode)
            ->create()
        ;

        $order->setShippingAddress($address->object());
        $order->setBillingAddress(clone $address->object());

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_ADDRESS);
    }

    private function selectShipping(OrderInterface $order, \DateTimeInterface $createdAt): void
    {
        if ($order->getCheckoutState() === OrderCheckoutStates::STATE_SHIPPING_SKIPPED) {
            return;
        }

        /** @var ChannelInterface $channel */
        $channel = $order->getChannel();
        $shippingMethods = $this->shippingMethodRepository->findEnabledForChannel($channel);

        if (count($shippingMethods) === 0) {
            /** @var Proxy<ShippingMethodInterface> $shippingMethod */
            $shippingMethod = ShippingMethodFactory::new()
                ->enabled()
                //->withChannels([$channel])
                ->create()
            ;

            $shippingMethods[] = $shippingMethod->object();
        }

        /** @var ShippingMethodInterface|null $shippingMethod */
        $shippingMethod = $this->faker->randomElement($shippingMethods);

        /** @var ChannelInterface $channel */
        $channel = $order->getChannel();
        Assert::notNull($shippingMethod, $this->generateInvalidSkipMessage('shipping', $channel->getCode() ?? ''));

        foreach ($order->getShipments() as $shipment) {
            $shipment->setMethod($shippingMethod);
            $shipment->setCreatedAt($createdAt);
        }

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_SELECT_SHIPPING);
    }

    private function selectPayment(OrderInterface $order, \DateTimeInterface $createdAt): void
    {
        if ($order->getCheckoutState() === OrderCheckoutStates::STATE_PAYMENT_SKIPPED) {
            return;
        }

        /** @var ChannelInterface $channel */
        $channel = $order->getChannel();

        /** @var PaymentMethodInterface|null $paymentMethod */
        $paymentMethod = $this
            ->faker
            ->randomElement($this->paymentMethodRepository->findEnabledForChannel($channel))
        ;

        Assert::notNull($paymentMethod, $this->generateInvalidSkipMessage('payment', $channel->getCode() ?? ''));

        foreach ($order->getPayments() as $payment) {
            $payment->setMethod($paymentMethod);
            $payment->setCreatedAt($createdAt);
        }

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_SELECT_PAYMENT);
    }

    private function completeCheckout(OrderInterface $order): void
    {
        if ($this->faker->boolean(25)) {
            $order->setNotes($this->faker->sentence);
        }

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_COMPLETE);
    }

    private function applyCheckoutStateTransition(OrderInterface $order, string $transition): void
    {
        $this->stateMachineFactory->get($order, OrderCheckoutTransitions::GRAPH)->apply($transition);
    }

    private function generateInvalidSkipMessage(string $type, string $channelCode): string
    {
        return sprintf(
            "No enabled %s method was found for the channel '%s'. " .
            "Set 'skipping_%s_step_allowed' option to true for this channel if you want to skip %s method selection.",
            $type,
            $channelCode,
            $type,
            $type,
        );
    }
}
