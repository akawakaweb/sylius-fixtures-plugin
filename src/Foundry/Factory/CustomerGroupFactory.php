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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Sylius\Bundle\CustomerBundle\Doctrine\ORM\CustomerGroupRepository;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Customer\Model\CustomerGroup;
use Sylius\Component\Customer\Model\CustomerGroupInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CustomerGroupInterface>
 *
 * @method        CustomerGroupInterface|Proxy create(array|callable $attributes = [])
 * @method static CustomerGroupInterface|Proxy createOne(array $attributes = [])
 * @method static CustomerGroupInterface|Proxy find(object|array|mixed $criteria)
 * @method static CustomerGroupInterface|Proxy findOrCreate(array $attributes)
 * @method static CustomerGroupInterface|Proxy first(string $sortedField = 'id')
 * @method static CustomerGroupInterface|Proxy last(string $sortedField = 'id')
 * @method static CustomerGroupInterface|Proxy random(array $attributes = [])
 * @method static CustomerGroupInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static CustomerGroupInterface[]|Proxy[] all()
 * @method static CustomerGroupInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CustomerGroupInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CustomerGroupInterface[]|Proxy[] findBy(array $attributes)
 * @method static CustomerGroupInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CustomerGroupInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CustomerGroupFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithCodeTrait;
    use WithNameTrait;

    private static ?string $modelClass = null;

    public static function withModelClass(string $modelClass): void
    {
        self::$modelClass = $modelClass;
    }

    protected function getDefaults(): array
    {
        return [
            'code' => self::faker()->text(),
            'name' => self::faker()->text(),
        ];
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? CustomerGroup::class;
    }
}
