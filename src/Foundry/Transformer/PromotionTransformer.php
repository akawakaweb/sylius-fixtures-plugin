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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionActionFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionCouponFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PromotionRuleFactory;
use Sylius\Component\Core\Model\PromotionCouponInterface;
use Sylius\Component\Promotion\Model\PromotionActionInterface;
use Sylius\Component\Promotion\Model\PromotionRuleInterface;

final class PromotionTransformer implements TransformerInterface
{
    use TransformChannelsAttributeTrait;

    public function transform(array $attributes): array
    {
        $attributes = $this->transformChannelsAttribute($attributes);
        $attributes = $this->transformRulesAttribute($attributes);
        $attributes = $this->transformActionsAttribute($attributes);

        return $this->transformCouponsAttributes($attributes);
    }

    private function transformCouponsAttributes(array $attributes): array
    {
        $coupons = [];

        /** @var PromotionCouponInterface|array $coupon */
        foreach ($attributes['coupons'] ?? [] as $coupon) {
            if (\is_array($coupon)) {
                $coupon = PromotionCouponFactory::new($coupon);
            }

            $coupons[] = $coupon;
        }

        $attributes['coupons'] = $coupons;

        return $attributes;
    }

    private function transformActionsAttribute(array $attributes): array
    {
        $actions = [];

        /** @var PromotionActionInterface|array $action */
        foreach ($attributes['actions'] ?? [] as $action) {
            if (\is_array($action)) {
                $action = PromotionActionFactory::new($action);
            }

            $actions[] = $action;
        }

        $attributes['actions'] = $actions;

        return $attributes;
    }

    private function transformRulesAttribute(array $attributes): array
    {
        $rules = [];

        /** @var PromotionRuleInterface|array $rule */
        foreach ($attributes['rules'] ?? [] as $rule) {
            if (\is_array($rule)) {
                $rule = PromotionRuleFactory::new($rule);
            }

            $rules[] = $rule;
        }

        $attributes['rules'] = $rules;

        return $attributes;
    }
}
