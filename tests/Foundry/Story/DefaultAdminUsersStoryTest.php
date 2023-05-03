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

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultAdminUsersStory;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultAdminUsersStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_default_admin_users(): void
    {
        self::bootKernel();

        DefaultAdminUsersStory::load();

        $adminUsers = $this->getAdminUserRepository()->findAll();

        $this->assertCount(2, $adminUsers);

        $adminUser = $adminUsers[0];
        $this->assertInstanceOf(AdminUserInterface::class, $adminUser);
        $this->assertEquals('sylius@example.com', $adminUser->getEmail());
        $this->assertEquals('sylius', $adminUser->getUsername());
        $this->assertTrue($adminUser->isEnabled());
        $this->assertEquals('en_US', $adminUser->getLocaleCode());
        $this->assertEquals('John', $adminUser->getFirstName());
        $this->assertEquals('Doe', $adminUser->getLastName());
        $this->assertStringEndsWith('john.jpg', $adminUser->getAvatar()->getPath());

        $adminUser = $adminUsers[1];
        $this->assertInstanceOf(AdminUserInterface::class, $adminUser);
        $this->assertEquals('api@example.com', $adminUser->getEmail());
        $this->assertEquals('api', $adminUser->getUsername());
        $this->assertTrue($adminUser->isEnabled());
        $this->assertEquals('en_US', $adminUser->getLocaleCode());
        $this->assertEquals('Luke', $adminUser->getFirstName());
        $this->assertEquals('Brushwood', $adminUser->getLastName());
        $this->assertStringEndsWith('luke.jpg', $adminUser->getAvatar()->getPath());
    }

    private function getAdminUserRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.admin_user');
    }
}
