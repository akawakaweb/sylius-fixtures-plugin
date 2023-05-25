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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Updater;

use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Order\Modifier\OrderItemQuantityModifierInterface;
use Webmozart\Assert\Assert;

final class OrderItemUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
        private OrderItemQuantityModifierInterface $orderItemQuantityModifier,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        $quantity = $attributes['quantity'] ?? 1;
        Assert::integer($quantity);

        unset($attributes['quantity']);

        Assert::isInstanceOf($object, OrderItemInterface::class);

        $this->orderItemQuantityModifier->modify($object, $quantity);

        return ($this->decorated)($object, $attributes);
    }
}
