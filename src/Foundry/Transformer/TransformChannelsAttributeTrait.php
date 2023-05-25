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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ChannelFactory;

trait TransformChannelsAttributeTrait
{
    private function transformChannelsAttribute(array $attributes): array
    {
        $channels = &$attributes['channels'];

        /**
         * @var int $key
         * @var mixed $channel
         */
        foreach ($channels ?? [] as $key => $channel) {
            if (\is_string($channel)) {
                $channel = ChannelFactory::findOrCreate(['code' => $channel]);
                $channels[$key] = $channel;
            }
        }

        return $attributes;
    }
}
