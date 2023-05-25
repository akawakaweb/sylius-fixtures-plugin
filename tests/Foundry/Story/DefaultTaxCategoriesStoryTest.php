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

namespace Tests\Akawakaweb\SyliusFixturesPlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultTaxCategoriesStory;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultTaxCategoriesStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_default_tax_categories(): void
    {
        self::bootKernel();

        DefaultTaxCategoriesStory::load();

        $taxCategories = $this->getTaxCategoryRepository()->findAll();

        $this->assertCount(2, $taxCategories);

        $taxCategory = $taxCategories[0];
        $this->assertInstanceOf(TaxCategoryInterface::class, $taxCategory);
        $this->assertEquals('clothing', $taxCategory->getCode());
        $this->assertEquals('Clothing', $taxCategory->getName());

        $taxCategory = $taxCategories[1];
        $this->assertInstanceOf(TaxCategoryInterface::class, $taxCategory);
        $this->assertEquals('other', $taxCategory->getCode());
        $this->assertEquals('Other', $taxCategory->getName());
    }

    private function getTaxCategoryRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.tax_category');
    }
}
