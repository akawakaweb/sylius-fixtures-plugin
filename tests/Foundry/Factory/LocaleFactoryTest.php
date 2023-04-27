<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Sylius\Component\Locale\Model\LocaleInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class LocaleFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_locale_with_random_code(): void
    {
        $locale = LocaleFactory::createOne();

        $this->assertInstanceOf(LocaleInterface::class, $locale->object());
        $this->assertNotNull($locale->getCode());
    }

    /** @test */
    function it_creates_locale_with_given_code(): void
    {
        $firstLocale = LocaleFactory::createOne(['code' => 'fr_FR']);
        $secondLocale = LocaleFactory::new()->withCode('pl_PL')->create();

        $this->assertEquals('fr_FR', $firstLocale->getCode());
        $this->assertEquals('pl_PL', $secondLocale->getCode());
    }
}
