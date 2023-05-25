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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ShippingMethodFactory;
use Zenstruck\Foundry\Story;

final class DefaultShippingMethodsStory extends Story implements DefaultShippingMethodsStoryInterface
{
    public function build(): void
    {
        ShippingMethodFactory::new()
            ->withCode('ups')
            ->withName('UPS')
            ->withChannels(['FASHION_WEB'])
            ->create()
        ;

        ShippingMethodFactory::new()
            ->withCode('dhl_express')
            ->withName('DHL Express')
            ->withChannels(['FASHION_WEB'])
            ->create()
        ;

        ShippingMethodFactory::new()
            ->withCode('fedex')
            ->withName('FedEx')
            ->withChannels(['FASHION_WEB'])
            ->create()
        ;
    }
}
