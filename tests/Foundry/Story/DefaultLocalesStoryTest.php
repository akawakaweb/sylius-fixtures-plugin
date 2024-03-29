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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultLocalesStory;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultLocalesStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_locales(): void
    {
        self::bootKernel();

        DefaultLocalesStory::load();

        $locales = $this->getLocaleRepository()->findAll();

        $this->assertCount(8, $locales);

        foreach ($this->getExpectedLocalesCodes() as $code) {
            $this->assertLocaleCodeExists($code);
        }
    }

    private function getExpectedLocalesCodes(): array
    {
        return [
            'en_US',
            'de_DE',
            'fr_FR',
            'pl_PL',
            'es_ES',
            'es_MX',
            'pt_PT',
            'zh_CN',
        ];
    }

    private function assertLocaleCodeExists(string $code): void
    {
        $currency = $this->getLocaleRepository()->findOneBy(['code' => $code]);
        $this->assertNotNull($currency, sprintf('Locale %s was not found.', $code));
    }

    private function getLocaleRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.locale');
    }
}
