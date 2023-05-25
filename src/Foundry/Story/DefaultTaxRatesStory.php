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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxRateFactory;
use Zenstruck\Foundry\Story;

final class DefaultTaxRatesStory extends Story implements DefaultTaxRatesStoryInterface
{
    public function build(): void
    {
        TaxRateFactory::new()
            ->withCode('clothing_sales_tax_7')
            ->withName('Clothing Sales Tax 7%')
            ->withZone('US')
            ->withCategory('clothing')
            ->withAmount(0.07)
            ->create()
        ;

        TaxRateFactory::new()
            ->withCode('sales_tax_20')
            ->withName('Sales Tax 20%')
            ->withZone('US')
            ->withCategory('other')
            ->withAmount(0.2)
            ->create()
        ;
    }
}
