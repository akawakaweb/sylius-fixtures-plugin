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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultPaymentMethodsStoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class DefaultPaymentMethodsFixtures extends Fixture
{
    public function __construct(
        private DefaultPaymentMethodsStoryInterface $defaultPaymentMethodsStory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->defaultPaymentMethodsStory::load();
    }
}
