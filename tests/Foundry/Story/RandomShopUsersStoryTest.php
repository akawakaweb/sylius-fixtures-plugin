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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomShopUsersStory;
use Sylius\Component\User\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomShopUsersStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_shop_users(): void
    {
        self::bootKernel();

        RandomShopUsersStory::load();

        $shopUsers = $this->getShopUserRepository()->findAll();

        $this->assertCount(20, $shopUsers);
    }

    private function getShopUserRepository(): UserRepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.shop_user');
    }
}
