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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductAttributeFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductOptionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxonFactory;
use Sylius\Component\Attribute\AttributeType\IntegerAttributeType;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;
use Zenstruck\Foundry\Story;

final class RandomDressesStory extends Story implements RandomDressesStoryInterface
{
    public function build(): void
    {
        $this->createTaxa();
        $this->createAttributes();
        $this->createOptions();
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
                    'code' => 'dresses',
                    'translations' => [
                        'en_US' => ['name' => 'Dresses'],
                        'fr_FR' => ['name' => 'Robes'],
                    ],
                ],
            ])
            ->create()
        ;
    }

    private function createAttributes(): void
    {
        ProductAttributeFactory::new()
            ->withCode('dress_brand')
            ->withName('Dress brand')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;

        ProductAttributeFactory::new()
            ->withCode('dress_collection')
            ->withName('Dress collection')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;

        ProductAttributeFactory::new()
            ->withCode('dress_material')
            ->withName('Dress material')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;

        ProductAttributeFactory::new()
            ->withCode('length')
            ->withName('Length')
            ->withType(IntegerAttributeType::TYPE)
            ->create()
        ;
    }

    private function createOptions(): void
    {
        ProductOptionFactory::new()
            ->withCode('dress_size')
            ->withName('Dress size')
            ->withValues([
                'dress_s' => 'S',
                'dress_m' => 'M',
                'dress_l' => 'L',
                'dress_xl' => 'XL',
                'dress_xxl' => 'XXL',
            ])
            ->create()
        ;

        ProductOptionFactory::new()
            ->withCode('dress_height')
            ->withName('Dress height')
            ->withValues([
                'dress_height_petite' => 'Petite',
                'dress_height_regular' => 'Regular',
                'dress_height_tall' => 'Tall',
            ])
            ->create()
        ;
    }

    private function createProducts(): void
    {
        $year = date('Y');

        ProductFactory::new()
            ->withName('Beige strappy summer dress')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('dresses')
            ->withTaxa(['dresses'])
            ->withProductAttributes([
                'dress_brand' => 'You are breathtaking',
                'dress_collection' => 'Sylius Winter ' . $year,
                'dress_material' => '100% polyester',
            ])
            ->withProductOptions([
                'dress_size',
                'dress_height',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/dresses/dress_01.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Off shoulder boho dress')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('dresses')
            ->withTaxa(['dresses'])
            ->withProductAttributes([
                'dress_brand' => 'You are breathtaking',
                'dress_collection' => 'Sylius Winter ' . $year,
                'dress_material' => '100% wool',
            ])
            ->withProductOptions([
                'dress_size',
                'dress_height',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/dresses/dress_02.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Ruffle wrap festival dress')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('dresses')
            ->withTaxa(['dresses'])
            ->withProductAttributes([
                'dress_brand' => 'You are breathtaking',
                'dress_collection' => 'Sylius Winter ' . $year,
                'dress_material' => '100% polyester',
                'length' => 100,
            ])
            ->withProductOptions([
                'dress_size',
                'dress_height',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/dresses/dress_03.jpg', 'type' => 'main'],
            ])
            ->create()
        ;
    }
}
