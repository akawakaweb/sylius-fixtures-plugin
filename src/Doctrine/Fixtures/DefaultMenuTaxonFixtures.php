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

namespace Akawakaweb\SyliusFixturesPlugin\Doctrine\Fixtures;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultMenuTaxonStoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class DefaultMenuTaxonFixtures extends Fixture
{
    public function __construct(
        private DefaultMenuTaxonStoryInterface $defaultMenuTaxonStory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->defaultMenuTaxonStory::load();
    }
}
