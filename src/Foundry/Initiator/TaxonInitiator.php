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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxonFactory;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Generator\TaxonSlugGeneratorInterface;
use Webmozart\Assert\Assert;

final class TaxonInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $taxonFactory,
        private RepositoryInterface $taxonRepository,
        private TaxonSlugGeneratorInterface $taxonSlugGenerator,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        /** @var string|null $code */
        $code = $attributes['code'] ?? null;

        /** @var TaxonInterface|null $taxon */
        $taxon = null !== $code ? $this->taxonRepository->findOneBy(['code' => $code]) : null;

        if (null === $taxon) {
            $taxon = $this->taxonFactory->createNew();
        }

        Assert::isInstanceOf($taxon, TaxonInterface::class);

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

        /** @var array $childAttributes */
        foreach ($attributes['children'] ?? [] as $childAttributes) {
            $childAttributes['parent'] = $taxon;

            TaxonFactory::new()
                ->withAttributes($childAttributes)
                ->withoutPersisting()
                ->create()
            ;
        }

        return $taxon;
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
