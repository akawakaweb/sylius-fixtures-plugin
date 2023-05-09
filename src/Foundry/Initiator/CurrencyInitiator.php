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

use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class CurrencyInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $currencyFactory,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $currency = $this->currencyFactory->createNew();
        Assert::isInstanceOf($currency, CurrencyInterface::class);

        $code = $attributes['code'] ?? null;
        Assert::nullOrString($code);

        $currency->setCode($code);

        return $currency;
    }
}
