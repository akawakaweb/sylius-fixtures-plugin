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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShopUserFactory;
use Sylius\Component\Core\Model\ShopUserInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ShopUserFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_shop_user_with_default_values(): void
    {
        $shopUser = ShopUserFactory::createOne();

        $this->assertInstanceOf(ShopUserInterface::class, $shopUser->object());
        $this->assertNotNull($shopUser->getCustomer()->getEmail());
        $this->assertNotNull($shopUser->getCustomer()->getFirstName());
        $this->assertNotNull($shopUser->getCustomer()->getLastName());
        $this->assertNotNull($shopUser->getCustomer()->getPhoneNumber());
        $this->assertNotNull($shopUser->getCustomer()->getBirthday());
        $this->assertNull($shopUser->getPlainPassword());
        $this->assertNotNull($shopUser->getPassword());
        //$this->assertNotNull($shopUser->getCustomer()->getGroup());
    }

    /** @test */
    public function it_creates_shop_user_with_given_email(): void
    {
        $shopUser = ShopUserFactory::new()->withEmail('shop@sylius.com')->create();

        $this->assertEquals('shop@sylius.com', $shopUser->getCustomer()->getEmail());
    }

    /** @test */
    public function it_creates_shop_user_with_given_first_name(): void
    {
        $shopUser = ShopUserFactory::new()->withFirstName('Marty')->create();

        $this->assertEquals('Marty', $shopUser->getCustomer()->getFirstName());
    }

    /** @test */
    public function it_creates_shop_user_with_given_last_name(): void
    {
        $shopUser = ShopUserFactory::new()->withLastName('McFly')->create();

        $this->assertEquals('McFly', $shopUser->getCustomer()->getLastName());
    }

    /** @test */
    public function it_creates_male_customer(): void
    {
        $shopUser = ShopUserFactory::new()->male()->create();

        $this->assertEquals('m', $shopUser->getCustomer()->getGender());
    }

    /** @test */
    public function it_creates_female_customer(): void
    {
        $shopUser = ShopUserFactory::new()->female()->create();

        $this->assertEquals('f', $shopUser->getCustomer()->getGender());
    }

    /** @test */
    public function it_creates_shop_user_with_given_phone_number(): void
    {
        $shopUser = ShopUserFactory::new()->withPhoneNumber('0102030405')->create();

        $this->assertEquals('0102030405', $shopUser->getCustomer()->getPhoneNumber());
    }

    /** @test */
    public function it_creates_shop_user_with_given_birthday(): void
    {
        $birthday = new \DateTimeImmutable('39 years ago');

        $shopUser = ShopUserFactory::new()->withBirthday($birthday)->create();

        $this->assertEquals($birthday, $shopUser->getCustomer()->getBirthday());
    }

    /** @test */
    public function it_creates_shop_user_with_given_birthday_via_relative_date(): void
    {
        $birthday = new \DateTimeImmutable('39 years ago');

        $shopUser = ShopUserFactory::new()->withBirthday('39 years ago')->create();

        $this->assertEquals($birthday->format('Y-m-d'), $shopUser->getCustomer()->getBirthday()->format('Y-m-d'));
    }

    /** @test */
    public function it_creates_shop_user_with_given_password(): void
    {
        $shopUser = ShopUserFactory::new()->withoutPersisting()->withPassword('passw0rd')->create();

        $this->assertEquals('passw0rd', $shopUser->getPlainPassword());
    }

//    /** @test */
//    function it_creates_shop_user_with_new_given_group(): void
//    {
//        $shopUser = ShopUserFactory::new()->withCustomerGroup('group_a')->create();
//
//        $this->assertEquals('group_a', $shopUser->getCustomer()->getGroup()->getCode());
//    }
//
//    /** @test */
//    function it_creates_shop_user_with_existing_proxy_given_group(): void
//    {
//        $customerGroup = CustomerGroupFactory::new()->withCode('group_a')->create();
//        $shopUser = ShopUserFactory::new()->withCustomerGroup($customerGroup)->create();
//
//        $this->assertEquals($customerGroup->object(), $shopUser->getCustomer()->getGroup());
//    }
//
//    /** @test */
//    function it_creates_shop_user_with_existing_given_group(): void
//    {
//        $customerGroup = CustomerGroupFactory::new()->withCode('group_a')->create()->object();
//        $shopUser = ShopUserFactory::new()->withCustomerGroup($customerGroup)->create();
//
//        $this->assertEquals($customerGroup, $shopUser->getCustomer()->getGroup());
//    }
}
