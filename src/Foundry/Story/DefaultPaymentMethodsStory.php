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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\PaymentMethodFactory;
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
