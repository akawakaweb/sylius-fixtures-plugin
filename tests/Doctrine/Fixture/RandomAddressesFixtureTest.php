<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Doctrine\Fixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomAddressesFixtureTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_random_addresses(): void
    {
        self::bootKernel();

        /** @var Fixture $fixture */
        $fixture = self::getContainer()->get('sylius.shop_fixtures.foundry.fixture.random_addresses');

        $fixture->load(self::getContainer()->get('doctrine.orm.entity_manager'));

        $addresses = $this->getAddressRepository()->findAll();

        $this->assertCount(10, $addresses);
    }

    private function getAddressRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.address');
    }
}
