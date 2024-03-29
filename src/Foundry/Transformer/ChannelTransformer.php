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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShopBillingDataFactory;

final class ChannelTransformer implements TransformerInterface
{
    use TransformCurrencyAttributeTrait;
    use TransformCurrenciesAttributeTrait;
    use TransformLocaleAttributeTrait;
    use TransformLocalesAttributeTrait;
    use TransformTaxonAttributeTrait;
    use TransformZoneAttributeTrait;

    public function transform(array $attributes): array
    {
        $attributes = $this->transformLocaleAttribute($attributes, 'defaultLocale');
        $attributes = $this->transformCurrencyAttribute($attributes, 'baseCurrency');
        $attributes = $this->transformCurrenciesAttribute($attributes);
        $attributes = $this->transformTaxonAttribute($attributes, 'menuTaxon');
        $attributes = $this->transformZoneAttribute($attributes, 'defaultTaxZone');

        $shopBillingData = $attributes['shopBillingData'] ?? null;

        if (\is_array($shopBillingData)) {
            $attributes['shopBillingData'] = ShopBillingDataFactory::new($shopBillingData);
        }

        return $this->transformLocalesAttribute($attributes);
    }
}
