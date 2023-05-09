<?php

/*
 * This file is part of ShopFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Transformer;

final class ShopUserTransformer implements ShopUserTransformerInterface
{
    public function __construct(
        private CustomerTransformerInterface $customerTransformer,
    ) {
    }

    public function transform(array $attributes): array
    {
        /** @var string|null $password */
        $password = $attributes['plainPassword'] ?? $attributes['password'] ?? null;

        $attributes['plainPassword'] = $password;
        unset($attributes['password']);

        return $this->customerTransformer->transform($attributes);
    }
}
