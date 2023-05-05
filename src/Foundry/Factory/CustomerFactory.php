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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\FemaleTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\MaleTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithBirthdayTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithEmailTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithFirstNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithLastNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithPhoneNumberTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\CustomerRepository;
use Sylius\Component\Core\Model\Customer;
use Sylius\Component\Core\Model\CustomerInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<CustomerInterface>
 *
 * @method        CustomerInterface|Proxy create(array|callable $attributes = [])
 * @method static CustomerInterface|Proxy createOne(array $attributes = [])
 * @method static CustomerInterface|Proxy find(object|array|mixed $criteria)
 * @method static CustomerInterface|Proxy findOrCreate(array $attributes)
 * @method static CustomerInterface|Proxy first(string $sortedField = 'id')
 * @method static CustomerInterface|Proxy last(string $sortedField = 'id')
 * @method static CustomerInterface|Proxy random(array $attributes = [])
 * @method static CustomerInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static CustomerRepository|RepositoryProxy repository()
 * @method static CustomerInterface[]|Proxy[] all()
 * @method static CustomerInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CustomerInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CustomerInterface[]|Proxy[] findBy(array $attributes)
 * @method static CustomerInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CustomerInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CustomerFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithEmailTrait;
    use WithFirstNameTrait;
    use WithLastNameTrait;
    use MaleTrait;
    use FemaleTrait;
    use WithPhoneNumberTrait;
    use WithBirthdayTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? Customer::class;
    }
}
