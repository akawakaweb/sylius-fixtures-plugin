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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxCategoryFactory;
use Zenstruck\Foundry\Story;

final class DefaultTaxCategoriesStory extends Story implements DefaultTaxCategoriesStoryInterface
{
    public function build(): void
    {
        TaxCategoryFactory::new()
            ->withCode('clothing')
            ->withName('Clothing')
            ->create()
        ;

        TaxCategoryFactory::new()
            ->withCode('other')
            ->withName('Other')
            ->create()
        ;
    }
}
