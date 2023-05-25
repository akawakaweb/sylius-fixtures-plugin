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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Updater;

use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Webmozart\Assert\Assert;

final class ChannelUpdater implements UpdaterInterface
{
    public function __construct(
        private UpdaterInterface $decorated,
    ) {
    }

    public function __invoke(object $object, array $attributes): array
    {
        Assert::isInstanceOf($object, ChannelInterface::class);

        $attributes = ($this->decorated)($object, $attributes);

        $defaultLocale = $attributes['defaultLocale'] ?? null;
        Assert::nullOrIsInstanceOf($defaultLocale, LocaleInterface::class);

        if (null !== $defaultLocale) {
            // Ensure Default locale is on available locale
            $object->addLocale($defaultLocale);
        }

        return $attributes;
    }
}
