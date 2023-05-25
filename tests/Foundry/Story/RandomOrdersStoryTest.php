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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomOrdersStory;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomOrdersStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_orders(): void
    {
        self::bootKernel();

        RandomOrdersStory::load();

        $orders = $this->getOrderRepository()->findAll();

        $this->assertCount(20, $orders);
    }

    private function getOrderRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.order');
    }
}
