<?php

/*
 * This file is part of SyliusFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxonFactory;
use Sylius\Component\Core\Model\TaxonInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class TaxonFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_taxon_with_random_code(): void
    {
        $taxon = TaxonFactory::createOne();

        $this->assertInstanceOf(TaxonInterface::class, $taxon->object());
        $this->assertNotNull($taxon->getCode());
    }

    /** @test */
    public function it_creates_taxon_with_given_code(): void
    {
        $taxon = TaxonFactory::new()->withCode('board-games')->create();

        $this->assertEquals('board-games', $taxon->getCode());
    }

    /** @test */
    public function it_creates_taxon_with_name_for_each_locale(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        LocaleFactory::new()->withCode('fr_FR')->create();

        $taxon = TaxonFactory::new()->withName('Board games')->create()->object();

        $this->assertEquals(2, $taxon->getTranslations()->count());

        $this->assertEquals('Board_games', $taxon->getCode());

        // testing en_US translation
        $taxon->setCurrentLocale('en_US');
        $taxon->setFallbackLocale('en_US');

        $this->assertEquals('Board games', $taxon->getName());
        $this->assertEquals('board-games', $taxon->getSlug());

        // testing fr_FR translation
        $taxon->setCurrentLocale('fr_fr');
        $taxon->setFallbackLocale('fr_FR');

        $this->assertEquals('Board games', $taxon->getName());
        $this->assertEquals('board-games', $taxon->getSlug());
    }

    /** @test */
    public function it_creates_taxon_with_slug_for_each_locale(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        LocaleFactory::new()->withCode('fr_FR')->create();

        $taxon = TaxonFactory::new()->withSlug('boardgames')->create()->object();

        $this->assertEquals(2, $taxon->getTranslations()->count());

        // testing en_US translation
        $taxon->setCurrentLocale('en_US');
        $taxon->setFallbackLocale('en_US');

        $this->assertEquals('boardgames', $taxon->getSlug());

        // testing fr_FR translation
        $taxon->setCurrentLocale('fr_fr');
        $taxon->setFallbackLocale('fr_FR');

        $this->assertEquals('boardgames', $taxon->getSlug());
    }

    /** @test */
    public function it_creates_taxon_with_description_for_each_locale(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        LocaleFactory::new()->withCode('fr_FR')->create();

        $taxon = TaxonFactory::new()->withDescription('Board games are awesome.')->create()->object();

        $this->assertEquals(2, $taxon->getTranslations()->count());

        // testing en_US translation
        $taxon->setCurrentLocale('en_US');
        $taxon->setFallbackLocale('en_US');

        $this->assertEquals('Board games are awesome.', $taxon->getDescription());

        // testing fr_FR translation
        $taxon->setCurrentLocale('fr_fr');
        $taxon->setFallbackLocale('fr_FR');

        $this->assertEquals('Board games are awesome.', $taxon->getDescription());
    }

    /** @test */
    public function it_creates_taxon_with_given_translations(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        LocaleFactory::new()->withCode('fr_FR')->create();

        $taxon = TaxonFactory::new()->withTranslations([
            'en_US' => [
                'name' => 'Board games',
            ],
            'fr_FR' => [
                'name' => 'Jeux de société',
            ],
        ])->create()->object();

        // testing en_US translation
        $taxon->setCurrentLocale('en_US');
        $taxon->setFallbackLocale('en_US');

        $this->assertEquals('Board games', $taxon->getName());
        $this->assertEquals('board-games', $taxon->getSlug());

        // testing fr_FR translation
        $taxon->setCurrentLocale('fr_FR');
        $taxon->setFallbackLocale('fr_FR');

        $this->assertEquals('Jeux de société', $taxon->getName());
        $this->assertEquals('jeux-de-societe', $taxon->getSlug());
    }

    /** @test */
    public function it_creates_taxon_with_given_children(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();

        $taxon = TaxonFactory::new()->withCode('categories')->withChildren([
            [
                'name' => 'Jeans',
            ],
            [
                'name' => 'Dresses',
            ],
        ])->create();

        $this->assertCount(2, $taxon->getChildren());

        /** @var TaxonInterface $firstTaxon */
        $firstTaxon = $taxon->getChildren()->first();
        $this->assertEquals('Jeans', $firstTaxon->getName());

        /** @var TaxonInterface $secondTaxon */
        $secondTaxon = $taxon->getChildren()->last();
        $this->assertEquals('Dresses', $secondTaxon->getName());
    }
}
