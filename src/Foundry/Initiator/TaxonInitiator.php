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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Updater\UpdaterInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class TaxonInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $taxonFactory,
        private RepositoryInterface $taxonRepository,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        /** @var string|null $code */
        $code = $attributes['code'] ?? null;

        /** @var TaxonInterface|null $taxon */
        $taxon = null !== $code ? $this->taxonRepository->findOneBy(['code' => $code]) : null;

        if (null === $taxon) {
            $taxon = $this->taxonFactory->createNew();
        }

        ($this->updater)($taxon, $attributes);

        return $taxon;
    }
}
