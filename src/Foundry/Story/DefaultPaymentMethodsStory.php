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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\PaymentMethodFactory;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultPaymentMethodsStory extends Story implements DefaultPaymentMethodsStoryInterface
{
    public function build(): void
    {
        PaymentMethodFactory::new()
            ->withCode('cash_on_delivery')
            ->withName('Cash on delivery')
            ->withChannels(['FASHION_WEB'])
            ->create()
        ;

        PaymentMethodFactory::new()
            ->withCode('bank_transfer')
            ->withName('Bank transfer')
            ->withChannels(['FASHION_WEB'])
            ->enabled()
            ->create()
        ;
    }
}
