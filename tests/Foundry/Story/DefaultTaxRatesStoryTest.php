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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultTaxRatesStory;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultTaxRatesStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_default_tax_rates(): void
    {
        self::bootKernel();

        DefaultTaxRatesStory::load();

        $taxRates = $this->getTaxRateRepository()->findAll();

        $this->assertCount(2, $taxRates);
    }

    private function getTaxRateRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.tax_rate');
    }
}
