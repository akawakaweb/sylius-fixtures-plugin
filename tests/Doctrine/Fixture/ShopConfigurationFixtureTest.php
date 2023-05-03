<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Doctrine\Fixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ShopConfigurationFixtureTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_shop_configuration(): void
    {
        self::bootKernel();

        /** @var Fixture $fixture */
        $fixture = self::getContainer()->get('sylius.shop_fixtures.foundry.fixture.shop_configuration');

        $fixture->load(self::getContainer()->get('doctrine.orm.entity_manager'));

        $adminUsers = $this->getAdminUserRepository()->findAll();
        $locales = $this->getLocaleRepository()->findAll();
        $channels = $this->getChannelRepository()->findAll();
        $countries = $this->getCountryRepository()->findAll();
        $currencies = $this->getCurrencyRepository()->findAll();
        $customerGroups = $this->getCustomerGroupRepository()->findAll();
        $customers = $this->getCustomerRepository()->findAll();
        $shippingMethods = $this->getShippingMethodRepository()->findAll();
        $taxa = $this->getTaxonRepository()->findAll();

        $this->assertCount(2, $adminUsers);
        $this->assertCount(8, $locales);
        $this->assertCount(1, $channels);
        $this->assertCount(12, $countries);
        $this->assertCount(9, $currencies);
        $this->assertCount(1, $customers);
        $this->assertCount(2, $customerGroups);
        $this->assertCount(3, $shippingMethods);
        $this->assertCount(1, $taxa);
    }

    private function getAdminUserRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.admin_user');
    }

    private function getChannelRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.channel');
    }

    private function getCountryRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.country');
    }

    private function getCurrencyRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.currency');
    }

    private function getCustomerRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.customer');
    }

    private function getCustomerGroupRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.customer_group');
    }

    private function getLocaleRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.locale');
    }

    private function getShippingMethodRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.shipping_method');
    }

    private function getTaxonRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.taxon');
    }
}
