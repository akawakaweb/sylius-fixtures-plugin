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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\TaxonFactory;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;
use Zenstruck\Foundry\Story;

final class RandomCapsStory extends Story implements RandomCapsStoryInterface
{
    public function build(): void
    {
        $this->createTaxa();
        $this->createAttributes();
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
                    'code' => 'caps',
                    'name' => 'Caps',
                    'slug' => 'caps',
                    'translations' => [
                        'en_US' => ['name' => 'Caps'],
                        'fr_FR' => ['name' => 'Bonnets'],
                    ],
                    'children' => [
                        [
                            'code' => 'simple_caps',
                            'translations' => [
                                'en_US' => [
                                    'name' => 'Simple',
                                    'slug' => 'caps/simple',
                                ],
                                'fr_FR' => [
                                    'name' => 'Simple',
                                    'slug' => 'bonnets/simple',
                                ],
                            ],
                        ],
                        [
                            'code' => 'caps_with_pompons',
                            'translations' => [
                                'en_US' => [
                                    'name' => 'With pompons',
                                    'slug' => 'caps/with-pompons',
                                ],
                                'fr_FR' => [
                                    'name' => 'À pompon',
                                    'slug' => 'bonnets/a-pompon',
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
            ->withCode('cap_brand')
            ->withName('Cap brand')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;

        ProductAttributeFactory::new()
            ->withCode('cap_collection')
            ->withName('Cap collection')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;

        ProductAttributeFactory::new()
            ->withCode('cap_material')
            ->withName('Cap material')
            ->withType(TextAttributeType::TYPE)
            ->create()
        ;
    }

    private function createProducts(): void
    {
        $year = date('Y');

        ProductFactory::new()
            ->withName('Knitted burgundy winter cap')
            ->withTaxCategory('other')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('caps_with_pompons')
            ->withTaxa(['caps', 'caps_with_pompons'])
            ->withProductAttributes([
                'cap_brand' => 'You are breathtaking',
                'cap_collection' => 'Sylius Winter ' . $year,
                'cap_material' => '100% wool',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/caps/cap_01.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Knitted wool-blend green cap')
            ->withTaxCategory('other')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('simple_caps')
            ->withTaxa(['caps', 'simple_caps'])
            ->withProductAttributes([
                'cap_brand' => 'Modern Wear',
                'cap_collection' => 'Sylius Winter ' . $year,
                'cap_material' => '100% wool',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/caps/cap_02.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Knitted white pompom cap')
            ->withTaxCategory('other')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('caps_with_pompons')
            ->withTaxa(['caps', 'caps_with_pompons'])
            ->withProductAttributes([
                'cap_brand' => 'Celsius Small',
                'cap_collection' => 'Sylius Winter ' . $year,
                'cap_material' => '100% wool',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/caps/cap_03.jpg', 'type' => 'main'],
            ])
            ->create()
        ;

        ProductFactory::new()
            ->withName('Cashmere-blend violet beanie')
            ->withTaxCategory('other')
            ->withChannels(['FASHION_WEB'])
            ->withMainTaxon('simple_caps')
            ->withTaxa(['caps', 'simple_caps'])
            ->withProductAttributes([
                'cap_brand' => 'Date & Banana',
                'cap_collection' => 'Sylius Winter ' . $year,
                'cap_material' => '100% cashmere',
            ])
            ->withImages([
                ['path' => '@SyliusCoreBundle/Resources/fixtures/caps/cap_04.jpg', 'type' => 'main'],
            ])
            ->create()
        ;
    }
}
