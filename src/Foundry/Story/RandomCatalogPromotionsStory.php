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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CatalogPromotionFactory;
use Sylius\Bundle\CoreBundle\CatalogPromotion\Calculator\FixedDiscountPriceCalculator;
use Sylius\Bundle\CoreBundle\CatalogPromotion\Calculator\PercentageDiscountPriceCalculator;
use Sylius\Bundle\CoreBundle\CatalogPromotion\Checker\InForProductScopeVariantChecker;
use Sylius\Bundle\CoreBundle\CatalogPromotion\Checker\InForTaxonsScopeVariantChecker;
use Sylius\Bundle\CoreBundle\CatalogPromotion\Checker\InForVariantsScopeVariantChecker;
use Zenstruck\Foundry\Story;

final class RandomCatalogPromotionsStory extends Story implements RandomCatalogPromotionsStoryInterface
{
    public function build(): void
    {
        CatalogPromotionFactory::new()
            ->enabled()
            ->withCode('winter')
            ->withName('Winter sale')
            ->withChannels(['FASHION_WEB'])
            ->notExclusive()
            ->withPriority(1)
            ->withScopes([
                [
                    'type' => InForVariantsScopeVariantChecker::TYPE,
                    'configuration' => [
                        'variants' => [
                            '000F_office_grey_jeans-variant-0',
                            '000F_office_grey_jeans-variant-1',
                            '000F_office_grey_jeans-variant-2',
                        ],
                    ],
                ],
            ])
            ->withActions([
                [
                    'type' => PercentageDiscountPriceCalculator::TYPE,
                    'configuration' => [
                        'amount' => 0.5,
                    ],
                ],
            ])
            ->create()
        ;

        CatalogPromotionFactory::new()
            ->enabled()
            ->withCode('spring')
            ->withName('Spring sale')
            ->withChannels(['FASHION_WEB'])
            ->notExclusive()
            ->withPriority(3)
            ->withScopes([
                [
                    'type' => InForTaxonsScopeVariantChecker::TYPE,
                    'configuration' => [
                        'taxons' => [
                            'jeans',
                        ],
                    ],
                ],
            ])
            ->withActions([
                [
                    'type' => FixedDiscountPriceCalculator::TYPE,
                    'configuration' => [
                        'FASHION_WEB' => [
                            'amount' => 3.00,
                        ],
                    ],
                ],
            ])
            ->create()
        ;

        CatalogPromotionFactory::new()
            ->enabled()
            ->withCode('summer')
            ->withName('Summer sale')
            ->withChannels(['FASHION_WEB'])
            ->exclusive()
            ->withPriority(4)
            ->withScopes([
                [
                    'type' => InForVariantsScopeVariantChecker::TYPE,
                    'configuration' => [
                        'variants' => [
                            '000F_office_grey_jeans-variant-0',
                        ],
                    ],
                ],
            ])
            ->withActions([
                [
                    'type' => PercentageDiscountPriceCalculator::TYPE,
                    'configuration' => [
                        'amount' => 0.5,
                    ],
                ],
            ])
            ->create()
        ;

        CatalogPromotionFactory::new()
            ->enabled()
            ->withCode('autumn')
            ->withName('Autumn sale')
            ->withStartDate('2 days')
            ->withEndDate('10 days')
            ->withChannels(['FASHION_WEB'])
            ->notExclusive()
            ->withPriority(2)
            ->withScopes([
                [
                    'type' => InForProductScopeVariantChecker::TYPE,
                    'configuration' => [
                        'products' => [
                            'Knitted_wool_blend_green_cap',
                        ],
                    ],
                ],
            ])
            ->withActions([
                [
                    'type' => PercentageDiscountPriceCalculator::TYPE,
                    'configuration' => [
                        'amount' => 0.5,
                    ],
                ],
            ])
            ->create()
        ;
    }
}
