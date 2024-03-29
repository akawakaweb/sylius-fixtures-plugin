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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\ToggableTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithAvatarTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithEmailTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithFirstNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithLastNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithLocaleCodeTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithPasswordTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithUsernameTrait;
use Sylius\Bundle\UserBundle\Doctrine\ORM\UserRepository;
use Sylius\Component\Core\Model\AdminUser;
use Sylius\Component\Core\Model\AdminUserInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<AdminUserInterface>
 *
 * @method        AdminUserInterface|Proxy create(array|callable $attributes = [])
 * @method static AdminUserInterface|Proxy createOne(array $attributes = [])
 * @method static AdminUserInterface|Proxy find(object|array|mixed $criteria)
 * @method static AdminUserInterface|Proxy findOrCreate(array $attributes)
 * @method static AdminUserInterface|Proxy first(string $sortedField = 'id')
 * @method static AdminUserInterface|Proxy last(string $sortedField = 'id')
 * @method static AdminUserInterface|Proxy random(array $attributes = [])
 * @method static AdminUserInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method static AdminUserInterface[]|Proxy[] all()
 * @method static AdminUserInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static AdminUserInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static AdminUserInterface[]|Proxy[] findBy(array $attributes)
 * @method static AdminUserInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AdminUserInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class AdminUserFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithEmailTrait;
    use WithUsernameTrait;
    use ToggableTrait;
    use WithPasswordTrait;
    use WithFirstNameTrait;
    use WithLastNameTrait;
    use WithLocaleCodeTrait;
    use WithAvatarTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? AdminUser::class;
    }
}
