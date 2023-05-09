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

use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class LocaleInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $localeFactory,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $locale = $this->localeFactory->createNew();
        Assert::isInstanceOf($locale, LocaleInterface::class);

        $code = $attributes['code'] ?? null;
        Assert::nullOrString($code);

        $locale->setCode($code);

        return $locale;
    }
}
