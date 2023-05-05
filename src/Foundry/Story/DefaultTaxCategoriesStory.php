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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxCategoryFactory;
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
