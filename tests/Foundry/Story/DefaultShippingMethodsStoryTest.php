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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultShippingMethodsStory;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultShippingMethodsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_default_shipping_methods(): void
    {
        self::bootKernel();

        LocaleFactory::new()->withCode('en_US')->create();
        DefaultShippingMethodsStory::load();

        $shippingMethods = $this->getShippingMethodRepository()->findAll();

        $this->assertCount(3, $shippingMethods);

        $shippingMethod = $shippingMethods[0];
        $this->assertInstanceOf(ShippingMethodInterface::class, $shippingMethod);
        $this->assertEquals('ups', $shippingMethod->getCode());

        $shippingMethod->setCurrentLocale('en_US');
        $this->assertEquals('UPS', $shippingMethod->getName());

        $shippingMethod = $shippingMethods[1];
        $this->assertInstanceOf(ShippingMethodInterface::class, $shippingMethod);
        $this->assertEquals('dhl_express', $shippingMethod->getCode());

        $shippingMethod->setCurrentLocale('en_US');
        $this->assertEquals('DHL Express', $shippingMethod->getName());

        $shippingMethod = $shippingMethods[2];
        $this->assertInstanceOf(ShippingMethodInterface::class, $shippingMethod);
        $this->assertEquals('fedex', $shippingMethod->getCode());

        $shippingMethod->setCurrentLocale('en_US');
        $this->assertEquals('FedEx', $shippingMethod->getName());
    }

    private function getShippingMethodRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.shipping_method');
    }
}
