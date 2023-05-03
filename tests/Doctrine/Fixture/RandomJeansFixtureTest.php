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

namespace Tests\Acme\SyliusExamplePlugin\Doctrine\Fixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomJeansFixtureTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_jeans(): void
    {
        self::bootKernel();

        /** @var Fixture $fixture */
        $fixture = self::getContainer()->get('sylius.shop_fixtures.foundry.fixture.random_jeans');

        $fixture->load(self::getContainer()->get('doctrine.orm.entity_manager'));

        $products = $this->getProductRepository()->findAll();

        $this->assertCount(8, $products);
    }

    private function getProductRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.product');
    }
}
