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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ZoneMemberFactory;
use Sylius\Component\Addressing\Model\ZoneMemberInterface;
use Zenstruck\Foundry\Proxy;

final class ZoneTransformer implements TransformerInterface
{
    use TransformNameToCodeAttributeTrait;

    public function transform(array $attributes): array
    {
        $attributes = $this->transformNameToCodeAttribute($attributes);

        return $this->transformZoneMemberAttribute($attributes);
    }

    private function transformZoneMemberAttribute(array $attributes): array
    {
        /** @var Proxy[]|ZoneMemberInterface[] $members */
        $members = [];

        /** @var Proxy|ZoneMemberInterface|string $member */
        foreach ($attributes['members'] ?? [] as $member) {
            if (\is_string($member)) {
                $member = ZoneMemberFactory::findOrCreate(['code' => $member]);
            }

            $members[] = $member;
        }

        $attributes['members'] = $members;

        return $attributes;
    }
}
