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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerFactory;
use Sylius\Component\Core\Model\CustomerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class CustomerFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_customer_with_default_values(): void
    {
        $customer = CustomerFactory::createOne();

        $this->assertInstanceOf(CustomerInterface::class, $customer->object());
        $this->assertNotNull($customer->getEmail());
        $this->assertNotNull($customer->getFirstName());
        $this->assertNotNull($customer->getLastName());
        $this->assertNotNull($customer->getPhoneNumber());
        $this->assertNotNull($customer->getBirthday());
        // $this->assertNotNull($customer->getGroup());
    }

    /** @test */
    public function it_creates_customer_with_given_email(): void
    {
        $firstCustomer = CustomerFactory::createOne(['email' => 'shop@sylius.com']);
        $secondCustomer = CustomerFactory::new()->withEmail('customer@sylius.com')->create();

        $this->assertEquals('shop@sylius.com', $firstCustomer->getEmail());
        $this->assertEquals('customer@sylius.com', $secondCustomer->getEmail());
    }

    /** @test */
    public function it_creates_customer_with_given_first_name(): void
    {
        $firstCustomer = CustomerFactory::createOne(['firstName' => 'Marty']);
        $secondCustomer = CustomerFactory::new()->withFirstName('Emmet')->create();

        $this->assertEquals('Marty', $firstCustomer->getFirstName());
        $this->assertEquals('Emmet', $secondCustomer->getFirstName());
    }

    /** @test */
    public function it_creates_customer_with_given_last_name(): void
    {
        $firstCustomer = CustomerFactory::createOne(['lastName' => 'McFly']);
        $secondCustomer = CustomerFactory::new()->withLastName('Brown')->create();

        $this->assertEquals('McFly', $firstCustomer->getLastName());
        $this->assertEquals('Brown', $secondCustomer->getLastName());
    }

    /** @test */
    public function it_creates_male_customer(): void
    {
        $firstCustomer = CustomerFactory::createOne(['gender' => 'm']);
        $secondCustomer = CustomerFactory::new()->male()->create();

        $this->assertEquals('m', $firstCustomer->getGender());
        $this->assertEquals('m', $secondCustomer->getGender());
    }

    /** @test */
    public function it_creates_female_customer(): void
    {
        $firstCustomer = CustomerFactory::createOne(['gender' => 'f']);
        $secondCustomer = CustomerFactory::new()->female()->create();

        $this->assertEquals('f', $firstCustomer->getGender());
        $this->assertEquals('f', $secondCustomer->getGender());
    }

    /** @test */
    public function it_creates_customer_with_given_phone_number(): void
    {
        $firstCustomer = CustomerFactory::createOne(['phoneNumber' => '0102030405']);
        $secondCustomer = CustomerFactory::new()->withPhoneNumber('01234567889')->create();

        $this->assertEquals('0102030405', $firstCustomer->getPhoneNumber());
        $this->assertEquals('01234567889', $secondCustomer->getPhoneNumber());
    }

    /** @test */
    public function it_creates_customer_with_given_birthday(): void
    {
        $firstBirthday = new \DateTimeImmutable('39 years ago');
        $secondBirthday = new \DateTimeImmutable('41 years ago');

        $firstCustomer = CustomerFactory::createOne(['birthday' => $firstBirthday]);
        $secondCustomer = CustomerFactory::new()->withBirthday($secondBirthday)->create();

        $this->assertEquals($firstBirthday->format('Y/m/d H:i:s'), $firstCustomer->getBirthday()->format('Y/m/d H:i:s'));
        $this->assertEquals($secondBirthday->format('Y/m/d H:i:s'), $secondCustomer->getBirthday()->format('Y/m/d H:i:s'));
    }

    /** @test */
    public function it_creates_customer_with_given_birthday_as_string(): void
    {
        $firstBirthday = new \DateTimeImmutable('39 years ago');
        $secondBirthday = new \DateTimeImmutable('41 years ago');

        $firstCustomer = CustomerFactory::createOne(['birthday' => '39 years ago']);
        $secondCustomer = CustomerFactory::new()->withBirthday($secondBirthday)->create();

        $this->assertEquals($firstBirthday->format('Y/m/d H:i:s'), $firstCustomer->getBirthday()->format('Y/m/d H:i:s'));
        $this->assertEquals($secondBirthday->format('Y/m/d H:i:s'), $secondCustomer->getBirthday()->format('Y/m/d H:i:s'));
    }
}
