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
use Sylius\Component\Core\Factory\PaymentMethodFactoryInterface;
use Webmozart\Assert\Assert;

final class PaymentMethodInitiator implements InitiatorInterface
{
    public function __construct(
        private PaymentMethodFactoryInterface $paymentMethodFactory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $gatewayFactory = $attributes['gatewayFactory'] ?? null;
        Assert::string($gatewayFactory);

        $paymentMethod = $this->paymentMethodFactory->createWithGateway($gatewayFactory);

        ($this->updater)($paymentMethod, $attributes);

        return $paymentMethod;
    }
}
