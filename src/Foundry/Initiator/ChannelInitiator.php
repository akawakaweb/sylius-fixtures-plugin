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

use Sylius\Component\Core\Model\ChannelInterface;

final class ChannelInitiator implements InitiatorInterface
{
    public function __construct(
        private InitiatorInterface $decorated,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        /** @var ChannelInterface $channel */
        $channel = ($this->decorated)($attributes, $class);

        $defaultLocale = $channel->getDefaultLocale();

        if (null !== $defaultLocale) {
            // Ensure Default locale is on available locale
            $channel->addLocale($defaultLocale);
        }

        return $channel;
    }
}
