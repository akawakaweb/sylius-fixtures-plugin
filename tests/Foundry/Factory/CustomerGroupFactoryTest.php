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

namespace Tests\Akawakaweb\SyliusFixturesPlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CustomerGroupFactory;
use Sylius\Component\Customer\Model\CustomerGroupInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class CustomerGroupFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_customer_group_with_random_code_and_name(): void
    {
        $customerGroup = CustomerGroupFactory::createOne();

        $this->assertInstanceOf(CustomerGroupInterface::class, $customerGroup->object());
        $this->assertNotNull($customerGroup->getCode());
        $this->assertNotNull($customerGroup->getName());
    }

    /** @test */
    public function it_creates_customer_group_with_given_code(): void
    {
        $firstCustomerGroup = CustomerGroupFactory::createOne(['code' => 'group_a']);
        $secondCustomerGroup = CustomerGroupFactory::new()->withCode('group_b')->create();

        $this->assertEquals('group_a', $firstCustomerGroup->getCode());
        $this->assertEquals('group_b', $secondCustomerGroup->getCode());
    }

    /** @test */
    public function it_creates_customer_group_with_given_name(): void
    {
        $firstCustomerGroup = CustomerGroupFactory::createOne(['name' => 'Group A']);
        $secondCustomerGroup = CustomerGroupFactory::new()->withName('Group B')->create();

        $this->assertEquals('Group A', $firstCustomerGroup->getName());
        $this->assertEquals('Group_A', $firstCustomerGroup->getCode());

        $this->assertEquals('Group B', $secondCustomerGroup->getName());
        $this->assertEquals('Group_B', $secondCustomerGroup->getCode());
    }
}
