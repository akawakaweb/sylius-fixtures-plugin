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
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Webmozart\Assert\Assert;

final class TaxCategoryInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $taxCategoryFactory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $taxCategory = $this->taxCategoryFactory->createNew();
        Assert::isInstanceOf($taxCategory, TaxCategoryInterface::class);

        ($this->updater)($taxCategory, $attributes);

        return $taxCategory;
    }
}
