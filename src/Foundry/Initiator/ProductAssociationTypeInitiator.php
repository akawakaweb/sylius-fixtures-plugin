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
use Sylius\Component\Product\Model\ProductAssociationTypeInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class ProductAssociationTypeInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $productAssociationTypeFactory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $productAssociationType = $this->productAssociationTypeFactory->createNew();
        Assert::isInstanceOf($productAssociationType, ProductAssociationTypeInterface::class);

        ($this->updater)($productAssociationType, $attributes);

        return $productAssociationType;
    }
}
