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

namespace Tests\Akawakaweb\SyliusFixturesPlugin;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @mixin KernelTestCase
 */
trait PurgeDatabaseTrait
{
    /**
     * @internal
     *
     * @before
     */
    public static function _resetSchema(): void
    {
        if (!\is_subclass_of(static::class, KernelTestCase::class)) {
            throw new \RuntimeException(\sprintf('The "%s" trait can only be used on TestCases that extend "%s".', __TRAIT__, KernelTestCase::class));
        }

        $kernel = static::createKernel();
        $kernel->boot();

        static::_purgeDatabase($kernel);

        $kernel->shutdown();
    }

    public static function _purgeDatabase(KernelInterface $kernel)
    {
        if (!$kernel->getContainer()->has('doctrine')) {
            return;
        }

        /** @var Registry $registry */
        $registry = $kernel->getContainer()->get('doctrine');

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $registry->getManager();

        $purger = new ORMPurger($entityManager);
        $purger->purge();

        $entityManager->clear();
    }
}
