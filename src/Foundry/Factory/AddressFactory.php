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

use Sylius\Bundle\CoreBundle\Doctrine\ORM\AddressRepository;
use Sylius\Component\Core\Model\Address;
use Sylius\Component\Core\Model\AddressInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Address>
 *
 * @method        AddressInterface|Proxy create(array|callable $attributes = [])
 * @method static AddressInterface|Proxy createOne(array $attributes = [])
 * @method static AddressInterface|Proxy find(object|array|mixed $criteria)
 * @method static AddressInterface|Proxy findOrCreate(array $attributes)
 * @method static AddressInterface|Proxy first(string $sortedField = 'id')
 * @method static AddressInterface|Proxy last(string $sortedField = 'id')
 * @method static AddressInterface|Proxy random(array $attributes = [])
 * @method static AddressInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static AddressRepository|RepositoryProxy repository()
 * @method static AddressInterface[]|Proxy[] all()
 * @method static AddressInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static AddressInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static AddressInterface[]|Proxy[] findBy(array $attributes)
 * @method static AddressInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AddressInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class AddressFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;

    protected function getDefaults(): array
    {
        return [
            'city' => self::faker()->text(),
            'countryCode' => self::faker()->text(),
            'createdAt' => self::faker()->dateTime(),
            'firstName' => self::faker()->text(),
            'lastName' => self::faker()->text(),
            'postcode' => self::faker()->text(),
            'street' => self::faker()->text(),
        ];
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Address::class;
    }
}
