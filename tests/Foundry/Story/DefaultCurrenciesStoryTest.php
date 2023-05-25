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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultCurrenciesStory;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultCurrenciesStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_currencies(): void
    {
        self::bootKernel();

        DefaultCurrenciesStory::load();

        $currencies = $this->getCurrencyRepository()->findAll();

        $this->assertCount(9, $currencies);

        foreach ($this->getExpectedCurrencyCodes() as $code) {
            $this->assertCurrencyCodeExists($code);
        }
    }

    private function getExpectedCurrencyCodes(): array
    {
        return [
            'EUR',
            'USD',
            'PLN',
            'CAD',
            'CNY',
            'NZD',
            'GBP',
            'AUD',
            'MXN',
        ];
    }

    private function assertCurrencyCodeExists(string $code): void
    {
        $currency = $this->getCurrencyRepository()->findOneBy(['code' => $code]);
        $this->assertNotNull($currency, sprintf('Currency %s was not found.', $code));
    }

    private function getCurrencyRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.currency');
    }
}
