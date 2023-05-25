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

final class ShopUserTransformer implements TransformerInterface
{
    public function __construct(
        private TransformerInterface $customerTransformer,
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
