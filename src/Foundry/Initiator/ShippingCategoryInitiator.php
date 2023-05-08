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

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Shipping\Model\ShippingCategoryInterface;
use Webmozart\Assert\Assert;

final class ShippingCategoryInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $shippingCategoryFactory,
    ) {
    }

    public function __invoke(array $attributes): object
    {
        $shippingCategory = $this->shippingCategoryFactory->createNew();
        Assert::isInstanceOf($shippingCategory, ShippingCategoryInterface::class);

        $shippingCategory->setCode($attributes['code'] ?? null);
        $shippingCategory->setName($attributes['name'] ?? null);
        $shippingCategory->setDescription($attributes['description'] ?? null);

        return $shippingCategory;
    }
}
