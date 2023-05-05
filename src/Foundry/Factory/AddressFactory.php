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

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\AddressDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\AddressTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\AddressUpdaterInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\AddressRepository;
use Sylius\Component\Core\Model\Address;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
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

    public function __construct(
        private FactoryInterface $factory,
        private AddressDefaultValuesInterface $defaultValues,
        private AddressTransformerInterface $transformer,
        private AddressUpdaterInterface $updater,
    ) {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return $this->defaultValues->getDefaultValues(self::faker());
    }

    protected function initialize(): self
    {
        return $this
            ->beforeInstantiate(fn (array $attributes): array => $this->transformer->transform($attributes))
            ->instantiateWith(function (): AddressInterface {
                /** @var AddressInterface $address */
                $address = $this->factory->createNew();

                return $address;
            })
            ->afterInstantiate(function (AddressInterface $address, array $attributes): void {
                $this->updater->update($address, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Address::class;
    }
}
