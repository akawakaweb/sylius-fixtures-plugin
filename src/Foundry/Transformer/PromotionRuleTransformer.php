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

final class PromotionRuleTransformer implements TransformerInterface
{
    public function transform(array $attributes): array
    {
        return $this->transformConfigurationAttribute($attributes);
    }

    private function transformConfigurationAttribute(array $attributes): array
    {
        $configuration = &$attributes['configuration'];

        foreach ($configuration as $channelCode => $channelConfiguration) {
            if (isset($channelConfiguration['amount'])) {
                $configuration[$channelCode]['amount'] = (int) ($channelConfiguration['amount'] * 100);
            }
        }

        return $attributes;
    }
}
