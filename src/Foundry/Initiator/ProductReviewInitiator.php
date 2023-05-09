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
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Review\Model\ReviewInterface;
use Webmozart\Assert\Assert;

final class ProductReviewInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $productReviewFactory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $productReview = $this->productReviewFactory->createNew();
        Assert::isInstanceOf($productReview, ReviewInterface::class);

        ($this->updater)($productReview, $attributes);

        return $productReview;
    }
}
