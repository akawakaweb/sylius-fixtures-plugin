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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\ShopUserFactory;
use Zenstruck\Foundry\Story;

final class DefaultShopUsersStory extends Story implements DefaultShopUsersStoryInterface
{
    public function build(): void
    {
        ShopUserFactory::new()
            ->withEmail('test@example.com')
            ->withFirstName('John')
            ->withLastName('Doe')
            ->withPassword('sylius')
            ->create()
        ;
    }
}
