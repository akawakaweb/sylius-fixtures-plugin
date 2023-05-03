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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ZoneMemberFactory;
use Sylius\Component\Addressing\Model\ZoneMemberInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ZoneMemberFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_zone_member(): void
    {
        $zoneMember = ZoneMemberFactory::createOne();

        $this->assertInstanceOf(ZoneMemberInterface::class, $zoneMember->object());
        $this->assertNotNull($zoneMember->getCode());
    }

    /** @test */
    public function it_creates_zone_member_with_given_code(): void
    {
        $zoneMember = ZoneMemberFactory::new()->withCode('united_states')->create();

        $this->assertEquals('united_states', $zoneMember->getCode());
    }
}
