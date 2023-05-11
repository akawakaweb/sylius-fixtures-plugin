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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultPaymentMethodsStory;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultPaymentMethodsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_default_payment_methods(): void
    {
        self::bootKernel();

        LocaleFactory::new()->withCode('en_US')->create();
        DefaultPaymentMethodsStory::load();

        $paymentMethods = $this->getPaymentMethodRepository()->findAll();

        $this->assertCount(2, $paymentMethods);

        $paymentMethod = $paymentMethods[0];
        $this->assertInstanceOf(PaymentMethodInterface::class, $paymentMethod);
        $this->assertEquals('cash_on_delivery', $paymentMethod->getCode());
        $this->assertEquals('Cash on delivery', $paymentMethod->getName());
        $this->assertCount(1, $paymentMethod->getChannels());
        $this->assertEquals('FASHION_WEB', $paymentMethod->getChannels()[0]->getCode());

        $paymentMethod = $paymentMethods[1];
        $this->assertInstanceOf(PaymentMethodInterface::class, $paymentMethod);
        $this->assertEquals('bank_transfer', $paymentMethod->getCode());
        $this->assertEquals('Bank transfer', $paymentMethod->getName());
        $this->assertCount(1, $paymentMethod->getChannels());
        $this->assertEquals('FASHION_WEB', $paymentMethod->getChannels()[0]->getCode());
        $this->assertTrue($paymentMethod->isEnabled());
    }

    private function getPaymentMethodRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.payment_method');
    }
}
