<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Doctrine\Fixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomShopUsersFixtureTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_random_shop_users(): void
    {
        self::bootKernel();

        /** @var Fixture $fixture */
        $fixture = self::getContainer()->get('sylius.shop_fixtures.foundry.fixture.random_shop_users');

        $fixture->load(self::getContainer()->get('doctrine.orm.entity_manager'));

        $shopUsers = $this->getShopUserRepository()->findAll();

        $this->assertCount(20, $shopUsers);
    }

    private function getShopUserRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.shop_user');
    }
}
