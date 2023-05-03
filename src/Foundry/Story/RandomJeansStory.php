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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ProductFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\TaxonFactory;
use Zenstruck\Foundry\Story;

final class RandomJeansStory extends Story
{
    public function build(): void
    {
        $this->createTaxa();
        //$this->createAttributes();
        //$this->createOptions();
        $this->createProducts();
    }

    private function createTaxa(): void
    {
        TaxonFactory::new()
            ->withCode('MENU_CATEGORY')
            ->withName('Category')
            ->withTranslations([
                'en_US' => ['name' => 'Category'],
                'fr_FR' => ['name' => 'Catégorie'],
            ])
            ->withChildren([
                [
                    'code' => 'jeans',
                    'name' => 'Jeans',
                    'translations' => [
                        'en_US' => ['name' => 'Jeans'],
                        'fr_FR' => ['name' => 'Jeans'],
                    ],
                    'children' => [
                        [
                            'code' => 'men_jeans',
                            'translations' => [
                                'en_US' => [
                                    'name' => 'Men',
                                    'slug' => 'jeans/men',
                                ],
                                'fr_FR' => [
                                    'name' => 'Hommes',
                                    'slug' => 'jeans/hommes',
                                ],
                            ],
                        ],
                        [
                            'code' => 'women_jeans',
                            'translations' => [
                                'en_US' => [
                                    'name' => 'Women',
                                    'slug' => 'jeans/women',
                                ],
                                'fr_FR' => [
                                    'name' => 'Femmes',
                                    'slug' => 'jeans/femmes',
                                ],
                            ],
                        ],
                    ],
                ],
            ])
            ->create()
        ;
    }

//    private function createAttributes(): void
//    {
//        $this->productAttributeFactory::new()
//            ->withCode('jeans_brand')
//            ->withName('Jeans brand')
//            ->withType(TextAttributeType::TYPE)
//            ->create()
//        ;
//
//        $this->productAttributeFactory::new()
//            ->withCode('jeans_collection')
//            ->withName('Jeans collection')
//            ->withType(TextAttributeType::TYPE)
//            ->create()
//        ;
//
//        $this->productAttributeFactory::new()
//            ->withCode('jeans_material')
//            ->withName('Jeans material')
//            ->withType(TextAttributeType::TYPE)
//            ->create()
//        ;
//    }

//    private function createOptions(): void
//    {
//        $this->productOptionFactory::new()
//            ->withCode('jeans_size')
//            ->withName('Jeans size')
//            ->withValues([
//                'jeans_size_s' => 'S',
//                'jeans_size_m' => 'M',
//                'jeans_size_l' => 'L',
//                'jeans_size_xl' => 'XL',
//                'jeans_size_xxl' => 'XXL',
//            ])
//            ->create()
//        ;
//    }

    private function createProducts(): void
    {
//        $year = date('Y');

        ProductFactory::new()
            ->withName('911M regular fit jeans')
//            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('mens_jeans')
//            ->withTaxa(['jeans', 'men_jeans'])
//            ->withProductAttributes([
//                'jeans_brand'=> 'You are breathtaking',
//                'jeans_collection' => 'Sylius Winter '.$year,
//                'jeans_material' => '100% jeans',
//            ])
//            ->withProductOptions([
//                'jeans_size',
//            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/jeans/man/jeans_01.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('330M slim fit jeans')
//            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('mens_jeans')
//            ->withTaxa(['jeans', 'men_jeans'])
//            ->withProductAttributes([
//                'jeans_brand'=> 'Modern Wear',
//                'jeans_collection' => 'Sylius Winter '.$year,
//                'jeans_material' => '100% jeans',
//            ])
//            ->withProductOptions([
//                'jeans_size',
//            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/jeans/man/jeans_02.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('990M regular fit jeans')
//            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('mens_jeans')
//            ->withTaxa(['jeans', 'men_jeans'])
//            ->withProductAttributes([
//                'jeans_brand'=> 'Celsius Small',
//                'jeans_collection' => 'Sylius Winter '.$year,
//                'jeans_material' => '100% jeans',
//            ])
//            ->withProductOptions([
//                'jeans_size',
//            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/jeans/man/jeans_03.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('007M black elegance jeans')
//            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('mens_jeans')
//            ->withTaxa(['jeans', 'men_jeans'])
//            ->withProductAttributes([
//                'jeans_brand'=> 'Date & Banana',
//                'jeans_collection' => 'Sylius Winter '.$year,
//                'jeans_material' => '100% jeans',
//            ])
//            ->withProductOptions([
//                'jeans_size',
//            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/jeans/man/jeans_04.svg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('727F patched cropped jeans')
//            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('women_jeans')
//            ->withTaxa(['jeans', 'women_jeans'])
//            ->withProductAttributes([
//                'jeans_brand'=> 'You are breathtaking',
//                'jeans_collection' => 'Sylius Winter '.$year,
//                'jeans_material' => '100% jeans',
//            ])
//            ->withProductOptions([
//                'jeans_size',
//            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/jeans/woman/jeans_01.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('111F patched jeans with fancy badges')
//            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('women_jeans')
//            ->withTaxa(['jeans', 'women_jeans'])
//            ->withProductAttributes([
//                'jeans_brand'=> 'You are breathtaking',
//                'jeans_collection' => 'Sylius Winter '.$year,
//                'jeans_material' => '100% jeans',
//            ])
//            ->withProductOptions([
//                'jeans_size',
//            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/jeans/woman/jeans_02.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('000F office grey jeans')
//            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('women_jeans')
//            ->withTaxa(['jeans', 'women_jeans'])
//            ->withProductAttributes([
//                'jeans_brand' => 'Modern Wear',
//                'jeans_collection' => 'Sylius Winter ' . $year,
//                'jeans_material' => '100% jeans',
//            ])
//            ->withProductOptions([
//                'jeans_size',
//            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/jeans/woman/jeans_03.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('666F boyfriend jeans with rips')
//            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('women_jeans')
//            ->withTaxa(['jeans', 'women_jeans'])
//            ->withProductAttributes([
//                'jeans_brand'=> 'Modern Wear',
//                'jeans_collection' => 'Sylius Winter '.$year,
//                'jeans_material' => '100% jeans',
//            ])
//            ->withProductOptions([
//                'jeans_size',
//            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/jeans/woman/jeans_04.jpg', 'type' => 'main'],
            ])
            ->create()
        ;
    }
}
