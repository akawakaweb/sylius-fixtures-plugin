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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Customer\Model\CustomerGroup;
use Sylius\Component\Customer\Model\CustomerGroupInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<CustomerGroupInterface>
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
final class CustomerGroupFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? CustomerGroup::class;
    }
}
