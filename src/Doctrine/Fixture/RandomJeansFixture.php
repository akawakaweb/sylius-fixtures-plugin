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

namespace Akawakaweb\ShopFixturesPlugin\Doctrine\Fixture;

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomJeansStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class RandomJeansFixture extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        RandomJeansStory::load();
    }

    public static function getGroups(): array
    {
        return ['random', 'random_products', 'random_jeans'];
    }

    public function getOrder(): int
    {
        return 2;
    }
}
