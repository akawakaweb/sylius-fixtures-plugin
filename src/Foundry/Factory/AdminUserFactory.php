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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\ToggableTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithAvatarTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithEmailTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithFirstNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithLastNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithLocaleCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithPasswordTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithUsernameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\AdminUserUpdaterInterface;
use Sylius\Bundle\UserBundle\Doctrine\ORM\UserRepository;
use Sylius\Component\Core\Model\AdminUser;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<AdminUserInterface>
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
final class AdminUserFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
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

    public function __construct(
        private FactoryInterface $factory,
        private AdminUserUpdaterInterface $updater,
    ) {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'createdAt' => self::faker()->dateTime(),
            'enabled' => self::faker()->boolean(),
            'localeCode' => self::faker()->text(12),
            'locked' => self::faker()->boolean(),
            'roles' => [],
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->instantiateWith(function (): AdminUserInterface {
                /** @var AdminUserInterface $adminUser */
                $adminUser = $this->factory->createNew();

                return $adminUser;
            })
            ->afterInstantiate(function (AdminUserInterface $adminUser, array $attributes): void {
                $this->updater->update($adminUser, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? AdminUser::class;
    }
}
