<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CountryFactory;
use Sylius\Component\Addressing\Model\CountryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Intl\Countries;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class CountryFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_country_with_random_code(): void
    {
        $country = CountryFactory::createOne();

        $this->assertInstanceOf(CountryInterface::class, $country->object());
        $this->assertNotNull($country->getCode());
        $this->assertTrue(Countries::exists($country->getCode()));
    }

    /** @test */
    function it_creates_country_with_given_code(): void
    {
        $firstCountry = CountryFactory::createOne(['code' => 'PL']);
        $secondCountry = CountryFactory::new()->withCode('FR')->create();

        $this->assertEquals('PL', $firstCountry->getCode());
        $this->assertEquals('FR', $secondCountry->getCode());
    }

    /** @test */
    function it_creates_enabled_country(): void
    {
        $country = CountryFactory::new()->enabled()->create();

        $this->assertTrue($country->isEnabled());
    }
}
