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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithFirstNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithLastNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithPhoneNumberTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\AddressRepository;
use Sylius\Component\Core\Model\Address;
use Sylius\Component\Core\Model\AddressInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<AddressInterface>
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
final class AddressFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithFirstNameTrait;
    use WithLastNameTrait;
    use WithPhoneNumberTrait;

    public function withCompany(?string $company = null): self
    {
        return $this->addState(['company' => $company ?? self::faker()->company()]);
    }

    public function withStreet(string $street): self
    {
        return $this->addState(['street' => $street]);
    }

    public function withCity(string $city): self
    {
        return $this->addState(['city' => $city]);
    }

    public function withPostcode(string $postcode): self
    {
        return $this->addState(['postcode' => $postcode]);
    }

    public function withCountryCode(string $countryCode): self
    {
        return $this->addState(['countryCode' => $countryCode]);
    }

    public function withProvinceName(string $provinceName): self
    {
        return $this->addState(['provinceName' => $provinceName]);
    }

    public function withProvinceCode(string $provinceCode): self
    {
        return $this->addState(['provinceCode' => $provinceCode]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Address::class;
    }
}
