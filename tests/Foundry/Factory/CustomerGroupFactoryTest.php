<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CustomerGroupFactory;
use Sylius\Component\Customer\Model\CustomerGroupInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class CustomerGroupFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_customer_group_with_random_code_and_name(): void
    {
        $customerGroup = CustomerGroupFactory::createOne();

        $this->assertInstanceOf(CustomerGroupInterface::class, $customerGroup->object());
        $this->assertNotNull($customerGroup->getCode());
        $this->assertNotNull($customerGroup->getName());
    }

    /** @test */
    function it_creates_customer_group_with_given_code(): void
    {
        $firstCustomerGroup = CustomerGroupFactory::createOne(['code' => 'group_a']);
        $secondCustomerGroup = CustomerGroupFactory::new()->withCode('group_b')->create();

        $this->assertEquals('group_a', $firstCustomerGroup->getCode());
        $this->assertEquals('group_b', $secondCustomerGroup->getCode());
    }

    /** @test */
    function it_creates_customer_group_with_given_name(): void
    {
        $firstCustomerGroup = CustomerGroupFactory::createOne(['name' => 'Group A']);
        $secondCustomerGroup = CustomerGroupFactory::new()->withName('Group B')->create();

        $this->assertEquals('Group A', $firstCustomerGroup->getName());
        $this->assertEquals('Group B', $secondCustomerGroup->getName());
    }
}
