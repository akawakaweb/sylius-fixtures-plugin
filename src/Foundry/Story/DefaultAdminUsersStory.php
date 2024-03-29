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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\AdminUserFactory;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultAdminUsersStory extends Story implements DefaultAdminUsersStoryInterface
{
    public function build(): void
    {
        Factory::delayFlush(function () {
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
        });
    }
}
