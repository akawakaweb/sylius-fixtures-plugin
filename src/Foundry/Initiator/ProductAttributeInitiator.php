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

use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;
use Sylius\Component\Attribute\Factory\AttributeFactoryInterface;
use Webmozart\Assert\Assert;

final class ProductAttributeInitiator implements InitiatorInterface
{
    public function __construct(
        private AttributeFactoryInterface $productAttributeFactory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $type = $attributes['type'];
        Assert::string($type);

        $productAttribute = $this->productAttributeFactory->createTyped($type);

        ($this->updater)($productAttribute, $attributes);

        return $productAttribute;
    }
}
