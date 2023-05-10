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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxonFactory;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Taxonomy\Generator\TaxonSlugGeneratorInterface;
use Webmozart\Assert\Assert;

final class TaxonUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
        private TaxonSlugGeneratorInterface $taxonSlugGenerator,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        if (!$object instanceof TaxonInterface) {
            return ($this->decorated)($object, $attributes);
        }

        // add translation for each defined locales
        foreach (LocaleFactory::all() as $locale) {
            $this->createTranslation($object, $locale->getCode() ?? '', $attributes);
        }

        // create or replace with custom translations
        /**
         * @var string $localeCode
         * @var array $translationAttributes
         */
        foreach ($attributes['translations'] ?? [] as $localeCode => $translationAttributes) {
            $this->createTranslation($object, $localeCode, array_merge($attributes, $translationAttributes));
        }

        /** @var array $childAttributes */
        foreach ($attributes['children'] ?? [] as $childAttributes) {
            $childAttributes['parent'] = $object;

            TaxonFactory::new()
                ->withAttributes($childAttributes)
                ->withoutPersisting()
                ->create()
            ;
        }

        unset($attributes['name'], $attributes['description'], $attributes['translations'], $attributes['slug'], $attributes['children']);

        return ($this->decorated)($object, $attributes);
    }

    private function createTranslation(TaxonInterface $taxon, string $localeCode, array $attributes = []): void
    {
        $taxon->setCurrentLocale($localeCode);
        $taxon->setFallbackLocale($localeCode);

        $name = $attributes['name'] ?? null;
        Assert::nullOrString($name);

        $description = $attributes['description'] ?? null;
        Assert::nullOrString($description);

        $slug = $attributes['slug'] ?? null;
        Assert::nullOrString($slug);

        $taxon->setName($name);
        $taxon->setDescription($description);
        $taxon->setSlug($slug ?? $this->taxonSlugGenerator->generate($taxon, $localeCode));
    }
}
