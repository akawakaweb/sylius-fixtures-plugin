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

use Faker\Factory;
use Faker\Generator;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Locale\Model\LocaleInterface;

final class OrderTransformer implements TransformerInterface
{
    use TransformChannelAttributeTrait;
    use TransformCustomerAttributeTrait;
    use TransformCountryAttributeTrait;

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function transform(array $attributes): array
    {
        $attributes = $this->transformCustomerAttribute($attributes);
        $attributes = $this->transformCountryAttribute($attributes);

        $attributes = $this->transformChannelAttribute($attributes);

        /** @var ChannelInterface|null $channel */
        $channel = $attributes['channel'] ?? null;

        if (null !== $channel) {
            $attributes['currencyCode'] = $channel->getBaseCurrency();

            /** @var LocaleInterface $locale */
            $locale = $this->faker->randomElement($channel->getLocales()->toArray());

            $attributes['localeCode'] = $locale->getCode();
        }

        return $attributes;
    }
}
