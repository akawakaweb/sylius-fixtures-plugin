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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\FemaleTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\MaleTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithBirthdayTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithEmailTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithFirstNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithLastNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithPasswordTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithPhoneNumberTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\UserRepository;
use Sylius\Component\Core\Model\ShopUser;
use Sylius\Component\Core\Model\ShopUserInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ShopUserInterface>
 *
 * @method        ShopUserInterface|Proxy create(array|callable $attributes = [])
 * @method static ShopUserInterface|Proxy createOne(array $attributes = [])
 * @method static ShopUserInterface|Proxy find(object|array|mixed $criteria)
 * @method static ShopUserInterface|Proxy findOrCreate(array $attributes)
 * @method static ShopUserInterface|Proxy first(string $sortedField = 'id')
 * @method static ShopUserInterface|Proxy last(string $sortedField = 'id')
 * @method static ShopUserInterface|Proxy random(array $attributes = [])
 * @method static ShopUserInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method static ShopUserInterface[]|Proxy[] all()
 * @method static ShopUserInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ShopUserInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ShopUserInterface[]|Proxy[] findBy(array $attributes)
 * @method static ShopUserInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ShopUserInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ShopUserFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithEmailTrait;
    use WithFirstNameTrait;
    use WithLastNameTrait;
    use WithPasswordTrait;
    use MaleTrait;
    use FemaleTrait;
    use WithPhoneNumberTrait;
    use WithBirthdayTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? ShopUser::class;
    }
}
