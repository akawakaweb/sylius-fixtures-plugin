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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Sylius\Component\Core\Model\CatalogPromotionInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Webmozart\Assert\Assert;

final class CatalogPromotionUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        if (!$object instanceof CatalogPromotionInterface) {
            return ($this->decorated)($object, $attributes);
        }

        /** @var LocaleInterface $locale */
        foreach (LocaleFactory::all() as $locale) {
            $localeCode = $locale->getCode() ?? '';

            $object->setCurrentLocale($localeCode);
            $object->setFallbackLocale($localeCode);

            $label = $attributes['label'] ?? null;
            Assert::nullOrString($label);

            $description = $attributes['description'] ?? null;
            Assert::nullOrString($description);

            $object->setLabel($label);
            $object->setDescription($description);
        }

        unset($attributes['label'], $attributes['description']);

        return ($this->decorated)($object, $attributes);
    }
}
