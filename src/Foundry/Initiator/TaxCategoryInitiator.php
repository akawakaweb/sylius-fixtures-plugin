<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Initiator;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Webmozart\Assert\Assert;

final class TaxCategoryInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $taxCategoryFactory,
    )
    {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $taxCategory = $this->taxCategoryFactory->createNew();
        Assert::isInstanceOf($taxCategory, TaxCategoryInterface::class);

        $taxCategory->setCode($attributes['code'] ?? null);
        $taxCategory->setName($attributes['name'] ?? null);
        $taxCategory->setDescription($attributes['description'] ?? null);
        $taxCategory->setCreatedAt($attributes['createdAt'] ?? null);

        return $taxCategory;
    }
}
