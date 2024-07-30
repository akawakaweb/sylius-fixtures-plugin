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

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Core\Model\ShopBillingData;
use Sylius\Component\Core\Model\ShopBillingDataInterface;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends AbstractModelFactory<ShopBillingDataInterface>
 *
 * @method        ShopBillingDataInterface|Proxy create(array|callable $attributes = [], bool $noProxy = false)
 * @method static ShopBillingDataInterface|Proxy createOne(array $attributes = [])
 * @method static ShopBillingDataInterface|Proxy find(object|array|mixed $criteria)
 * @method static ShopBillingDataInterface|Proxy findOrCreate(array $attributes)
 * @method static ShopBillingDataInterface|Proxy first(string $sortedField = 'id')
 * @method static ShopBillingDataInterface|Proxy last(string $sortedField = 'id')
 * @method static ShopBillingDataInterface|Proxy random(array $attributes = [])
 * @method static ShopBillingDataInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|ProxyRepositoryDecorator repository()
 * @method static ShopBillingDataInterface[]|Proxy[] all()
 * @method static ShopBillingDataInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ShopBillingDataInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ShopBillingDataInterface[]|Proxy[] findBy(array $attributes)
 * @method static ShopBillingDataInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ShopBillingDataInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ShopBillingDataFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;

    public function withCompany(string $company): self
    {
        return $this->with(['company' => $company]);
    }

    public function withTaxId(string $taxId): self
    {
        return $this->with(['taxId' => $taxId]);
    }

    public function withCountryCode(string $countryCode): self
    {
        return $this->with(['countryCode' => $countryCode]);
    }

    public function withStreet(string $street): self
    {
        return $this->with(['street' => $street]);
    }

    public function withCity(string $city): self
    {
        return $this->with(['city' => $city]);
    }

    public function withPostcode(string $postcode): self
    {
        return $this->with(['postcode' => $postcode]);
    }

    public function defaults(): array
    {
        return [];
    }

    public static function class(): string
    {
        return self::$modelClass ?? ShopBillingData::class;
    }
}
