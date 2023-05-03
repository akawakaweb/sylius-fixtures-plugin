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

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultShopUsersStory;
use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\Component\User\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultShopUsersStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_default_shop_users(): void
    {
        self::bootKernel();

        DefaultShopUsersStory::load();

        $shopUsers = $this->getShopUserRepository()->findAll();

        $this->assertCount(1, $shopUsers);

        $shopUser = $this->findShopUserByEmail('test@example.com');
        $this->assertEquals('John', $shopUser->getCustomer()->getFirstName());
        $this->assertEquals('Doe', $shopUser->getCustomer()->getLastName());
    }

    private function findShopUserByEmail(string $email): ShopUserInterface
    {
        $customerGroup = $this->getShopUserRepository()->findOneByEmail($email);

        $this->assertNotNull($customerGroup, sprintf('Customer group %s was not found.', 'retail'));

        return $customerGroup;
    }

    private function getShopUserRepository(): UserRepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.shop_user');
    }
}
