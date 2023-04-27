<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CurrencyFactory;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Intl\Currencies;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class CurrencyFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_currency_with_random_code(): void
    {
        $currency = CurrencyFactory::createOne();

        $this->assertInstanceOf(CurrencyInterface::class, $currency->object());
        $this->assertNotNull($currency->getCode());
        $this->assertTrue(Currencies::exists($currency->getCode()));
    }

    /** @test */
    function it_creates_currency_with_given_code(): void
    {
        $firstCurrency = CurrencyFactory::createOne(['code' => 'EUR']);
        $secondCurrency = CurrencyFactory::new()->withCode('USD')->create();

        $this->assertEquals('EUR', $firstCurrency->getCode());
        $this->assertEquals('USD', $secondCurrency->getCode());
    }
}
