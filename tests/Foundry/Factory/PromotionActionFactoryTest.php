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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionActionFactory;
use Sylius\Component\Promotion\Model\PromotionActionInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class PromotionActionFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_promotion_action_with_default_values(): void
    {
        $promotionAction = PromotionActionFactory::createOne();

        $this->assertInstanceOf(PromotionActionInterface::class, $promotionAction->object());
        $this->assertEquals('order_percentage_discount', $promotionAction->getType());
        $this->assertCount(1, $promotionAction->getConfiguration());
    }

    /** @test */
    public function it_creates_promotion_action_with_given_type(): void
    {
        $promotionAction = PromotionActionFactory::new()->withType('order_fixed_discount')->create();

        $this->assertEquals('order_fixed_discount', $promotionAction->getType());
    }

    /** @test */
    public function it_creates_promotion_action_with_given_configuration(): void
    {
        $promotionAction = PromotionActionFactory::new()->withConfiguration(['foo' => 'fighters'])->create();

        $this->assertEquals(['foo' => 'fighters'], $promotionAction->getConfiguration());
    }

//    /** @test */
//    public function it_transforms_configuration_amount(): void
//    {
//        $promotionAction = PromotionActionFactory::new()
//            ->withConfiguration(['default_channel' => ['amount' => 1]])
//            ->create()
//        ;
//
//        $this->assertEquals(['default_channel' => ['amount' => 100]], $promotionAction->getConfiguration());
//    }

//    /** @test */
//    public function it_transforms_configuration_percentage(): void
//    {
//        $promotionAction = PromotionActionFactory::new()
//            ->withConfiguration(['default_channel' => ['percentage' => 10]])
//            ->create()
//        ;
//
//        $this->assertEquals(['default_channel' => ['percentage' => 0.1]], $promotionAction->getConfiguration());
//    }
}
