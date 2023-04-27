<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture;

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomAddressesStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class RandomAddressesFixture extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        RandomAddressesStory::load();
    }

    public static function getGroups(): array
    {
        return ['random', 'random_addresses'];
    }

    public function getOrder(): int
    {
        return 2;
    }
}
