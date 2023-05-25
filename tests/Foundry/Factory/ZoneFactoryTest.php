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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneMemberFactory;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\Scope;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ZoneFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_zone(): void
    {
        $zone = ZoneFactory::createOne();

        $this->assertInstanceOf(ZoneInterface::class, $zone->object());
        $this->assertNotNull($zone->getCode());
        $this->assertEquals('all', $zone->getScope());
    }

    /** @test */
    public function it_creates_zone_with_given_code(): void
    {
        $zone = ZoneFactory::new()->withCode('world')->create();

        $this->assertEquals('world', $zone->getCode());
    }

    /** @test */
    public function it_creates_zone_with_given_name(): void
    {
        $zone = ZoneFactory::new()->withName('Rest of the World')->create();

        $this->assertEquals('Rest of the World', $zone->getName());
        $this->assertEquals('Rest_of_the_World', $zone->getCode());
    }

    /** @test */
    public function it_creates_zone_with_new_members(): void
    {
        $zone = ZoneFactory::new()->withMembers(['united_states', 'france'])->create();

        $this->assertEquals('zone', $zone->getType());
        $this->assertCount(2, $zone->getMembers());
    }

    /** @test */
    public function it_creates_zone_with_existing_proxy_members(): void
    {
        $firstZoneMember = ZoneMemberFactory::new()->withCode('zone_a')->create();
        $secondZoneMember = ZoneMemberFactory::new()->withCode('zone_b')->create();

        $zone = ZoneFactory::new()->withMembers([$firstZoneMember, $secondZoneMember])->create();

        $this->assertEquals('zone', $zone->getType());
        $this->assertCount(2, $zone->getMembers());

        $this->assertTrue($zone->hasMember($firstZoneMember->object()));
        $this->assertTrue($zone->hasMember($secondZoneMember->object()));
    }

    /** @test */
    public function it_creates_zone_with_existing_members(): void
    {
        $firstZoneMember = ZoneMemberFactory::new()->withCode('zone_a')->create()->object();
        $secondZoneMember = ZoneMemberFactory::new()->withCode('zone_b')->create()->object();

        $zone = ZoneFactory::new()->withMembers([$firstZoneMember, $secondZoneMember])->create();

        $this->assertEquals('zone', $zone->getType());
        $this->assertCount(2, $zone->getMembers());

        $this->assertTrue($zone->hasMember($firstZoneMember));
        $this->assertTrue($zone->hasMember($secondZoneMember));
    }

    /** @test */
    public function it_creates_zone_with_new_countries(): void
    {
        $zone = ZoneFactory::new()->withCountries(['FR', 'EN'])->create();

        $this->assertEquals('country', $zone->getType());
        $this->assertCount(2, $zone->getMembers());
    }

    /** @test */
    public function it_creates_zone_with_existing_proxy_countries(): void
    {
        $firstZoneMember = ZoneMemberFactory::new()->withCode('FR')->create();
        $secondZoneMember = ZoneMemberFactory::new()->withCode('EN')->create();

        $zone = ZoneFactory::new()->withCountries([$firstZoneMember, $secondZoneMember])->create();

        $this->assertEquals('country', $zone->getType());
        $this->assertCount(2, $zone->getMembers());

        $this->assertTrue($zone->hasMember($firstZoneMember->object()));
        $this->assertTrue($zone->hasMember($secondZoneMember->object()));
    }

    /** @test */
    public function it_creates_zone_with_existing_countries(): void
    {
        $firstZoneMember = ZoneMemberFactory::new()->withCode('FR')->create()->object();
        $secondZoneMember = ZoneMemberFactory::new()->withCode('EN')->create()->object();

        $zone = ZoneFactory::new()->withCountries([$firstZoneMember, $secondZoneMember])->create();

        $this->assertEquals('country', $zone->getType());
        $this->assertCount(2, $zone->getMembers());

        $this->assertTrue($zone->hasMember($firstZoneMember));
        $this->assertTrue($zone->hasMember($secondZoneMember));
    }

    /** @test */
    public function it_creates_zone_with_new_provinces(): void
    {
        $zone = ZoneFactory::new()->withProvinces(['US-TX', 'US-ME'])->create();

        $this->assertEquals('province', $zone->getType());
        $this->assertCount(2, $zone->getMembers());
    }

    /** @test */
    public function it_creates_zone_with_existing_proxy_provinces(): void
    {
        $firstZoneMember = ZoneMemberFactory::new()->withCode('US-TX')->create();
        $secondZoneMember = ZoneMemberFactory::new()->withCode('US-ME')->create();

        $zone = ZoneFactory::new()->withProvinces([$firstZoneMember, $secondZoneMember])->create();

        $this->assertEquals('province', $zone->getType());
        $this->assertCount(2, $zone->getMembers());

        $this->assertTrue($zone->hasMember($firstZoneMember->object()));
        $this->assertTrue($zone->hasMember($secondZoneMember->object()));
    }

    /** @test */
    public function it_creates_zone_with_existing_provinces(): void
    {
        $firstZoneMember = ZoneMemberFactory::new()->withCode('US-TX')->create()->object();
        $secondZoneMember = ZoneMemberFactory::new()->withCode('US-ME')->create()->object();

        $zone = ZoneFactory::new()->withProvinces([$firstZoneMember, $secondZoneMember])->create();

        $this->assertEquals('province', $zone->getType());
        $this->assertCount(2, $zone->getMembers());

        $this->assertTrue($zone->hasMember($firstZoneMember));
        $this->assertTrue($zone->hasMember($secondZoneMember));
    }

    /** @test */
    public function it_creates_zone_with_given_scope(): void
    {
        $zone = ZoneFactory::new()->withScope(Scope::TAX)->create();

        $this->assertEquals(Scope::TAX, $zone->getScope());
    }
}
