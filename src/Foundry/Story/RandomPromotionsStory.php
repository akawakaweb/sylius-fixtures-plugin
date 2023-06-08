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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionFactory;
use Sylius\Component\Core\Promotion\Action\FixedDiscountPromotionActionCommand;
use Zenstruck\Foundry\Story;

final class RandomPromotionsStory extends Story implements RandomPromotionsStoryInterface
{
    public function build(): void
    {
        PromotionFactory::new()
            ->withCode('christmas')
            ->withName('Christmas')
            ->withChannels(['FASHION_WEB'])
            ->couponBased()
            ->withCoupons([
                [
                    'code' => 'CHRISTMAS_SALE',
                    'expiresAt' => 'December 24',
                    'usageLimit' => 10,
                    'perCustomerUsageLimit' => 1,
                ],
            ])
            ->create()
        ;

        PromotionFactory::new()
            ->withCode('new_year')
            ->withName('New Year')
            ->withUsageLimit(10)
            ->withPriority(2)
            ->withStartDate(new \DateTimeImmutable('-7 day'))
            ->withEndDate(new \DateTimeImmutable('-7 day'))
            ->withChannels(['FASHION_WEB'])
            ->couponBased()
            ->withRules([
                [
                    'type' => 'item_total',
                    'configuration' => [
                        'FASHION_WEB' => ['amount' => 100.00],
                    ],
                ],
            ])
            ->withActions([
                [
                    'type' => FixedDiscountPromotionActionCommand::TYPE,
                    'configuration' => [
                        'FASHION_WEB' => ['amount' => 10.00],
                    ],
                ],
            ])
            ->create()
        ;
    }
}
