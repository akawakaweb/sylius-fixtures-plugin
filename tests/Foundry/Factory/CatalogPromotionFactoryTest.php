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

namespace Tests\Akawakaweb\SyliusFixturesPlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CatalogPromotionActionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CatalogPromotionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CatalogPromotionScopeFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ChannelFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Sylius\Component\Core\Model\CatalogPromotionInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class CatalogPromotionFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_catalog_promotion_with_random_data(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        ChannelFactory::createMany(3);
        $catalogPromotion = CatalogPromotionFactory::createOne();

        $this->assertInstanceOf(CatalogPromotionInterface::class, $catalogPromotion->object());
        $this->assertNotNull($catalogPromotion->getCode());
        $this->assertNotNull($catalogPromotion->getName());
        //$this->assertNotNull($catalogPromotion->getLabel());
        //$this->assertNotNull($catalogPromotion->getDescription());
        //$this->assertCount(3, $catalogPromotion->getChannels());
        $this->assertEquals(0, $catalogPromotion->getPriority());
        //$this->assertFalse($catalogPromotion->isExclusive());
        //$this->assertTrue($catalogPromotion->isEnabled());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_code(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->withCode('PROMO')->create();

        $this->assertEquals('PROMO', $catalogPromotion->getCode());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_name(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->withName('Black friday')->create();

        $this->assertEquals('Black friday', $catalogPromotion->getName());
        $this->assertEquals('Black_friday', $catalogPromotion->getCode());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_label(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $catalogPromotion = CatalogPromotionFactory::new()->withLabel('Blackest')->create();

        $this->assertEquals('Blackest', $catalogPromotion->getLabel());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_description(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $catalogPromotion = CatalogPromotionFactory::new()->withDescription('Blackest hours')->create();

        $this->assertEquals('Blackest hours', $catalogPromotion->getDescription());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_channels_as_proxy(): void
    {
        $channel = ChannelFactory::createOne();
        $catalogPromotion = CatalogPromotionFactory::new()->withChannels([$channel])->create();

        $firstChannel = $catalogPromotion->getChannels()->first() ?: null;
        $this->assertEquals($channel->object(), $firstChannel);
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_channels(): void
    {
        $channel = ChannelFactory::createOne()->object();
        $catalogPromotion = CatalogPromotionFactory::new()->withChannels([$channel])->create();

        $firstChannel = $catalogPromotion->getChannels()->first() ?: null;
        $this->assertEquals($channel, $firstChannel);
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_channels_as_string(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->withChannels(['default'])->create();

        $this->assertEquals('default', $catalogPromotion->getChannels()->first()->getCode());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_scopes_as_proxy(): void
    {
        $scope = CatalogPromotionScopeFactory::createOne();
        $catalogPromotion = CatalogPromotionFactory::new()->withScopes([$scope])->create();

        $this->assertEquals($scope->object(), $catalogPromotion->getScopes()->first());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_scopes(): void
    {
        $scope = CatalogPromotionScopeFactory::createOne()->object();
        $catalogPromotion = CatalogPromotionFactory::new()->withScopes([$scope])->create();

        $this->assertEquals($scope, $catalogPromotion->getScopes()->first());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_scopes_as_array(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->withScopes([
            [
                'type' => 'for_variants',
                'configuration' => [
                    'variants' => [
                        '000F_office_grey_jeans-variant-0',
                        '000F_office_grey_jeans-variant-1',
                        '000F_office_grey_jeans-variant-2',
                    ],
                ],
            ],
        ])->create();

        $firstScope = $catalogPromotion->getScopes()->first() ?: null;

        $this->assertNotNull($firstScope);
        $this->assertEquals('for_variants', $firstScope->getType());
        $this->assertEquals([
            'variants' => [
                '000F_office_grey_jeans-variant-0',
                '000F_office_grey_jeans-variant-1',
                '000F_office_grey_jeans-variant-2',
            ],
        ], $firstScope->getConfiguration());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_actions_as_proxy(): void
    {
        $action = CatalogPromotionActionFactory::createOne();
        $catalogPromotion = CatalogPromotionFactory::new()->withActions([$action])->create();

        $this->assertEquals($action->object(), $catalogPromotion->getActions()->first());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_actions(): void
    {
        $action = CatalogPromotionActionFactory::createOne()->object();
        $catalogPromotion = CatalogPromotionFactory::new()->withActions([$action])->create();

        $this->assertEquals($action, $catalogPromotion->getActions()->first());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_actions_as_array(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->withActions([
            [
                'type' => 'percentage_discount',
                'configuration' => [
                    'amount' => 0.5,
                ],
            ],
        ])->create();

        $firstAction = $catalogPromotion->getActions()->first() ?: null;

        $this->assertNotNull($firstAction);
        $this->assertEquals('percentage_discount', $firstAction->getType());
        $this->assertEquals([
            'amount' => 0.5,
        ], $firstAction->getConfiguration());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_priority(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->withPriority(42)->create();

        $this->assertEquals(42, $catalogPromotion->getPriority());
    }

    /** @test */
    public function it_creates_exclusive_catalog_promotion(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->exclusive()->create();

        $this->assertTrue($catalogPromotion->isExclusive());
    }

    /** @test */
    public function it_creates_not_exclusive_catalog_promotion(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->notExclusive()->create();

        $this->assertFalse($catalogPromotion->isExclusive());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_start_date(): void
    {
        $startDate = new \DateTimeImmutable('today');
        $catalogPromotion = CatalogPromotionFactory::new()->withStartDate($startDate)->create();

        $this->assertEquals($startDate, $catalogPromotion->getStartDate());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_start_date_as_string(): void
    {
        $startDate = new \DateTimeImmutable('today');
        $catalogPromotion = CatalogPromotionFactory::new()->withStartDate('today')->create();

        $this->assertEquals($startDate, $catalogPromotion->getStartDate());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_end_date(): void
    {
        $endDate = new \DateTimeImmutable('tomorrow');
        $catalogPromotion = CatalogPromotionFactory::new()->withEndDate($endDate)->create();

        $this->assertEquals($endDate, $catalogPromotion->getEndDate());
    }

    /** @test */
    public function it_creates_catalog_promotion_with_given_end_date_as_string(): void
    {
        $endDate = new \DateTimeImmutable('tomorrow');
        $catalogPromotion = CatalogPromotionFactory::new()->withEndDate('tomorrow')->create();

        $this->assertEquals($endDate, $catalogPromotion->getEndDate());
    }

    /** @test */
    public function it_creates_enabled_catalog_promotion(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->enabled()->create();

        $this->assertTrue($catalogPromotion->isEnabled());
    }

    /** @test */
    public function it_creates_disabled_catalog_promotion(): void
    {
        $catalogPromotion = CatalogPromotionFactory::new()->disabled()->create();

        $this->assertFalse($catalogPromotion->isEnabled());
    }
}
