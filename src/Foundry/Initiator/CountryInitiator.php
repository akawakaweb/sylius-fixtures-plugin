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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Initiator;

use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class CountryInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $countryFactory,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $country = $this->countryFactory->createNew();
        Assert::isInstanceOf($country, CountryInterface::class);

        $code = $attributes['code'] ?? null;
        Assert::nullOrString($code);

        $enabled = $attributes['enabled'] ?? null;
        Assert::nullOrBoolean($enabled);

        $country->setCode($code);
        $country->setEnabled($enabled ?? true);

        return $country;
    }
}
