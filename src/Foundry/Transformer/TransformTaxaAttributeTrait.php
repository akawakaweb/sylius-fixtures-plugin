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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxonFactory;

trait TransformTaxaAttributeTrait
{
    private function transformTaxaAttribute(array $attributes): array
    {
        $taxa = &$attributes['taxa'];

        /**
         * @var int $key
         * @var mixed $taxon
         */
        foreach ($taxa ?? [] as $key => $taxon) {
            if (\is_string($taxon)) {
                $taxon = TaxonFactory::findOrCreate(['code' => $taxon]);
                $taxa[$key] = $taxon;
            }
        }

        return $attributes;
    }
}
