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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAssociationFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAssociationTypeFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductFactory;
use Zenstruck\Foundry\Story;

final class RandomProductAssociationsStory extends Story implements RandomProductAssociationsStoryInterface
{
    private const AMOUNT = 3;

    private const ASSOCIATED_PRODUCT_AMOUNT = 2;

    public function build(): void
    {
        $productAssociationType = ProductAssociationTypeFactory::new()
            ->withCode('similar_products')
            //->withName('Similar products')
            ->create()
        ;

        $productCount = ProductFactory::count();

        if ($productCount < self::AMOUNT) {
            ProductFactory::createMany(self::AMOUNT - $productCount);
        }

        $products = ProductFactory::randomSet(self::AMOUNT);

        foreach ($products as $product) {
            ProductAssociationFactory::new()
                ->withType($productAssociationType)
                ->withOwner($product)
                ->withAssociatedProducts(ProductFactory::randomSet(self::ASSOCIATED_PRODUCT_AMOUNT))
                ->create()
            ;
        }
    }
}
