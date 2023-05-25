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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionRuleFactory;
use Sylius\Component\Promotion\Checker\Rule\ItemTotalRuleChecker;
use Sylius\Component\Promotion\Model\PromotionRuleInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class PromotionRuleFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_promotion_rule(): void
    {
        $promotionRule = PromotionRuleFactory::createOne();

        $this->assertInstanceOf(PromotionRuleInterface::class, $promotionRule->object());
        $this->assertEquals('cart_quantity', $promotionRule->getType());
        $this->assertArrayHasKey('count', $promotionRule->getConfiguration());
    }

    /** @test */
    public function it_creates_promotion_rule_with_given_type(): void
    {
        $promotionRule = PromotionRuleFactory::new()->withType(ItemTotalRuleChecker::TYPE)->create();

        $this->assertEquals(ItemTotalRuleChecker::TYPE, $promotionRule->getType());
    }

    /** @test */
    public function it_creates_promotion_rule_with_given_configuration(): void
    {
        $promotionRule = PromotionRuleFactory::new()->withConfiguration(['foo' => 'fighters'])->create();

        $this->assertEquals(['foo' => 'fighters'], $promotionRule->getConfiguration());
    }

//    /** @test */
//    function it_transforms_the_amount(): void
//    {
//        $promotionRule = PromotionRuleFactory::new()->withConfiguration(['default_channel' => ['amount' => 1]])->create();
//
//        $this->assertEquals(['default_channel' => ['amount' => 100]], $promotionRule->getConfiguration());
//    }
}
