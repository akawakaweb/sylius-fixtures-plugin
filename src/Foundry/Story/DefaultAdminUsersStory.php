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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\AdminUserFactory;
use Zenstruck\Foundry\Story;

final class DefaultAdminUsersStory extends Story
{
    public function build(): void
    {
        AdminUserFactory::new()
            ->withEmail('sylius@example.com')
            ->withUsername('sylius')
            ->withPassword('sylius')
            ->enabled()
            ->withLocaleCode('en_US')
            ->withFirstName('John')
            ->withLastName('Doe')
            ->withAvatar('@SyliusCoreBundle/Resources/fixtures/adminAvatars/john.jpg')
            ->create()
        ;

        AdminUserFactory::new()
            ->withEmail('api@example.com')
            ->withUsername('api')
            ->withPassword('sylius')
            ->enabled()
            ->withLocaleCode('en_US')
            ->withFirstName('Luke')
            ->withLastName('Brushwood')
            ->withAvatar('@SyliusCoreBundle/Resources/fixtures/adminAvatars/luke.jpg')
            ->create()
        ;
    }
}
