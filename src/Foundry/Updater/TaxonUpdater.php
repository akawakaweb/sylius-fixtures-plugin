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
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Taxonomy\Generator\TaxonSlugGeneratorInterface;

final class TaxonUpdater implements TaxonUpdaterInterface
{
    public function __construct(
        private TaxonSlugGeneratorInterface $taxonSlugGenerator,
    ) {
    }

    public function update(TaxonInterface $taxon, array $attributes): void
    {
        /** @var string|null $code */
        $code = $attributes['code'] ?? null;

        $taxon->setCode($code);

        /** @var TaxonInterface|null $parentTaxon */
        $parentTaxon = $attributes['parent'] ?? null;

        if (null !== $parentTaxon) {
            $taxon->setParent($parentTaxon);
        }

        // add translation for each defined locales
        foreach (LocaleFactory::all() as $locale) {
            $this->createTranslation($taxon, $locale->getCode() ?? '', $attributes);
        }

        // create or replace with custom translations
        /**
         * @var string $localeCode
         * @var array $translationAttributes
         */
        foreach ($attributes['translations'] ?? [] as $localeCode => $translationAttributes) {
            $this->createTranslation($taxon, $localeCode, array_merge($attributes, $translationAttributes));
        }
    }

    private function createTranslation(TaxonInterface $taxon, string $localeCode, array $attributes = []): void
    {
        $taxon->setCurrentLocale($localeCode);
        $taxon->setFallbackLocale($localeCode);

        /** @var string|null $slug */
        $slug = $attributes['slug'] ?? null;

        $taxon->setName($attributes['name'] ?? null);
        $taxon->setDescription($attributes['description'] ?? null);
        $taxon->setSlug($slug ?? $this->taxonSlugGenerator->generate($taxon, $localeCode));
    }
}
