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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;
use Sylius\Component\Attribute\Factory\AttributeFactoryInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Webmozart\Assert\Assert;
use Zenstruck\Foundry\Proxy;

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
        Assert::isInstanceOf($productAttribute, ProductAttributeInterface::class);

        /** @var Proxy<LocaleInterface> $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $productAttribute->setCurrentLocale($localeCode);
            $productAttribute->setFallbackLocale($localeCode);

            $name = $attributes['name'] ?? null;
            Assert::nullOrString($name);

            $productAttribute->setName($name);
        }

        unset($attributes['type'], $attributes['name']);

        ($this->updater)($productAttribute, $attributes);

        return $productAttribute;
    }
}
