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
use Sylius\Component\Attribute\AttributeType\PercentAttributeType;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;
use Zenstruck\Foundry\Story;

final class RandomTShirtsStory extends Story implements RandomTShirtsStoryInterface
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
                    'code' => 't_shirts',
                    'name' => 'T-shirts',
                    'slug' => 't-shirts',
                    'translations' => [
                        'en_US' => ['name' => 'T-shirts'],
                        'fr_FR' => ['name' => 'T-shirts'],
                    ],
                    'children' => [
                        [
                            'code' => 'men_t_shirts',
                            'translations' => [
                                'en_US' => [
                                    'name' => 'Men',
                                    'slug' => 't-shirts/men',
                                ],
                                'fr_FR' => [
                                    'name' => 'Hommes',
                                    'slug' => 't-shirts/hommes',
                                ],
                            ],
                        ],
                        [
                            'code' => 'women_t_shirts',
                            'translations' => [
                                'en_US' => [
                                    'name' => 'Women',
                                    'slug' => 't-shirts/women',
                                ],
                                'fr_FR' => [
                                    'name' => 'Femmes',
                                    'slug' => 't-shirts/femmes',
                                ],
                            ],
                        ],
                    ],
                ],
            ])
            ->create()
        ;
    }

    private function createAttributes(): void
    {
        ProductAttributeFactory::new()
            ->withCode('t_shirt_brand')
            ->withName('T-shirt brand')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;

        ProductAttributeFactory::new()
            ->withCode('t_shirt_collection')
            ->withName('T-shirt collection')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;

        ProductAttributeFactory::new()
            ->withCode('t_shirt_material')
            ->withName('T-shirt material')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;

        ProductAttributeFactory::new()
            ->withCode('damage_reduction')
            ->withName('Damage reduction')
            ->withType(PercentAttributeType::TYPE)
            ->create()
        ;
    }

    private function createOptions(): void
    {
        ProductOptionFactory::new()
            ->withCode('t_shirt_size')
            ->withName('T-shirt size')
            ->withValues([
                't_shirt_size_s' => 'S',
                't_shirt_size_m' => 'M',
                't_shirt_size_l' => 'L',
                't_shirt_size_xl' => 'XL',
                't_shirt_size_xxl' => 'XXL',
            ])
            ->create()
        ;
    }

    private function createProducts(): void
    {
        $year = date('Y');

        ProductFactory::new()
            ->withName('Everyday white basic T-Shirt')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('women_t_shirts')
            ->withTaxa(['t_shirts', 'women_t_shirts'])
            ->withProductAttributes([
                't_shirt_brand' => 'You are breathtaking',
                't_shirt_collection' => 'Sylius Winter ' . $year,
                't_shirt_material' => '100% cotton',
                'damage_reduction' => 0.1,
            ])
            ->withProductOptions([
                't_shirt_size',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/t-shirts/woman/t-shirt_01.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Loose white designer T-Shirt')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('women_t_shirts')
            ->withTaxa(['t_shirts', 'women_t_shirts'])
            ->withProductAttributes([
                't_shirt_brand' => 'Modern Wear',
                't_shirt_collection' => 'Sylius Winter ' . $year,
                't_shirt_material' => '100% cotton',
            ])
            ->withProductOptions([
                't_shirt_size',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/t-shirts/woman/t-shirt_02.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Ribbed copper slim fit Tee')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('women_t_shirts')
            ->withTaxa(['t_shirts', 'women_t_shirts'])
            ->withProductAttributes([
                't_shirt_brand' => 'Celsius Small',
                't_shirt_collection' => 'Sylius Winter ' . $year,
                't_shirt_material' => '100% viscose',
            ])
            ->withProductOptions([
                't_shirt_size',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/t-shirts/woman/t-shirt_03.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Sport basic white T-Shirt')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('men_t_shirts')
            ->withTaxa(['t_shirts', 'men_t_shirts'])
            ->withProductAttributes([
                't_shirt_brand' => 'You are breathtaking',
                't_shirt_collection' => 'Sylius Winter ' . $year,
                't_shirt_material' => '100% viscose',
            ])
            ->withProductOptions([
                't_shirt_size',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/t-shirts/man/t-shirt_01.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Raglan grey & black Tee')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('men_t_shirts')
            ->withTaxa(['t_shirts', 'men_t_shirts'])
            ->withProductAttributes([
                't_shirt_brand' => 'You are breathtaking',
                't_shirt_collection' => 'Sylius Winter ' . $year,
                't_shirt_material' => '100% cotton',
            ])
            ->withProductOptions([
                't_shirt_size',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/t-shirts/man/t-shirt_02.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Oversize white cotton T-Shirt')
            ->withTaxCategory('clothing')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('men_t_shirts')
            ->withTaxa(['t_shirts', 'men_t_shirts'])
            ->withProductAttributes([
                't_shirt_brand' => 'Modern Wear',
                't_shirt_collection' => 'Sylius Winter ' . $year,
                't_shirt_material' => '100% cotton',
            ])
            ->withProductOptions([
                't_shirt_size',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/t-shirts/man/t-shirt_03.jpg', 'type' => 'main'],
            ])
            ->create()
        ;
    }
}
