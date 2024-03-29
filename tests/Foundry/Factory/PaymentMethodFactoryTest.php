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

namespace Tests\Akawakaweb\SyliusFixturesPlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PaymentMethodFactory;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class PaymentMethodFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_payment_method_with_default_values(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        ChannelFactory::createMany(3);
        $paymentMethod = PaymentMethodFactory::createOne();

        $this->assertInstanceOf(PaymentMethodInterface::class, $paymentMethod->object());
        $this->assertNotNull($paymentMethod->getCode());
        $this->assertNotNull($paymentMethod->getName());
        //$this->assertNotNull($paymentMethod->getDescription());
        $this->assertNull($paymentMethod->getInstructions());
        $this->assertSame('Offline', $paymentMethod->getGatewayConfig()->getGatewayName());
        //$this->assertCount(3, $paymentMethod->getChannels());
    }

    /** @test */
    public function it_creates_payment_method_with_given_code(): void
    {
        $paymentMethod = PaymentMethodFactory::new()->withCode('PM2')->create();

        $this->assertEquals('PM2', $paymentMethod->getCode());
    }

    /** @test */
    public function it_creates_payment_method_with_given_name(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $paymentMethod = PaymentMethodFactory::new()->withName('Payment method 2')->create();

        $this->assertEquals('Payment method 2', $paymentMethod->getName());
        $this->assertEquals('Payment_method_2', $paymentMethod->getCode());
    }

    /** @test */
    public function it_creates_payment_method_with_given_description(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $paymentMethod = PaymentMethodFactory::new()->withDescription('Credit card')->create();

        $this->assertEquals('Credit card', $paymentMethod->getDescription());
    }

    /** @test */
    public function it_creates_payment_method_with_given_instructions(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $paymentMethod = PaymentMethodFactory::new()->withInstructions('Bank account: 0000 1111 2222 3333')->create();

        $this->assertEquals('Bank account: 0000 1111 2222 3333', $paymentMethod->getInstructions());
    }

    /** @test */
    public function it_creates_payment_method_with_given_gateway_name(): void
    {
        $paymentMethod = PaymentMethodFactory::new()->withGatewayName('Online')->create();

        $this->assertEquals('Online', $paymentMethod->getGatewayConfig()->getGatewayName());
    }

    /** @test */
    public function it_creates_payment_method_with_given_gateway_factory(): void
    {
        $paymentMethod = PaymentMethodFactory::new()->withGatewayFactory('online')->create();

        $this->assertEquals('online', $paymentMethod->getGatewayConfig()->getFactoryName());
    }

    /** @test */
    public function it_creates_payment_method_with_given_gateway_config(): void
    {
        $paymentMethod = PaymentMethodFactory::new()->withGatewayConfig(['foo' => 'fighters'])->create();

        $this->assertEquals(['foo' => 'fighters'], $paymentMethod->getGatewayConfig()->getConfig());
    }

    /** @test */
    public function it_creates_enabled_payment_method(): void
    {
        $paymentMethod = PaymentMethodFactory::new()->enabled()->create();

        $this->assertTrue($paymentMethod->isEnabled());
    }

    /** @test */
    public function it_creates_disabled_payment_method(): void
    {
        $paymentMethod = PaymentMethodFactory::new()->disabled()->create();

        $this->assertFalse($paymentMethod->isEnabled());
    }

    /** @test */
    public function it_creates_payment_method_with_given_channels_as_proxy(): void
    {
        $channel = ChannelFactory::createOne();
        $paymentMethod = PaymentMethodFactory::new()->withChannels([$channel])->create();

        $this->assertEquals($channel->object(), $paymentMethod->getChannels()->first());
    }

    /** @test */
    public function it_creates_payment_method_with_given_channels(): void
    {
        $channel = ChannelFactory::createOne()->object();
        $paymentMethod = PaymentMethodFactory::new()->withChannels([$channel])->create();

        $this->assertEquals($channel, $paymentMethod->getChannels()->first());
    }

    /** @test */
    public function it_creates_payment_method_with_given_channels_as_string(): void
    {
        $paymentMethod = PaymentMethodFactory::new()->withChannels(['default'])->create();

        $this->assertEquals('default', $paymentMethod->getChannels()->first()->getCode());
    }
}
