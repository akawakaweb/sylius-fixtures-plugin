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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultGeographicalStory;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultGeographicalStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_countries(): void
    {
        self::bootKernel();

        DefaultGeographicalStory::load();

        $countries = $this->getCountryRepository()->findAll();

        $this->assertCount(12, $countries);

        foreach ($this->getExpectedCountryCodes() as $code) {
            $this->assertCountryCodeExists($code);
        }
    }

    /** @test */
    public function it_creates_zones(): void
    {
        self::bootKernel();

        DefaultGeographicalStory::load();

        $zones = $this->getZoneRepository()->findAll();

        $this->assertCount(2, $zones);

        $zone = $zones[0];
        $this->assertInstanceOf(ZoneInterface::class, $zone);
        $this->assertEquals('United States of America', $zone->getName());
        $this->assertCount(1, $zone->getMembers());

        $zone = $zones[1];
        $this->assertInstanceOf(ZoneInterface::class, $zone);
        $this->assertEquals('Rest of the World', $zone->getName());
        $this->assertCount(11, $zone->getMembers());
    }

    private function getExpectedCountryCodes(): array
    {
        return [
            'US',
            'FR',
            'DE',
            'AU',
            'CA',
            'MX',
            'NZ',
            'PT',
            'ES',
            'CN',
            'GB',
            'PL',
        ];
    }

    private function assertCountryCodeExists(string $code): void
    {
        $currency = $this->getCountryRepository()->findOneBy(['code' => $code]);
        $this->assertNotNull($currency, sprintf('Country %s was not found.', $code));
    }

    private function getCountryRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.country');
    }

    private function getZoneRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.zone');
    }
}
