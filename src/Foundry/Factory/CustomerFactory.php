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

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\FemaleTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\MaleTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithBirthdayTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithEmailTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithFirstNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithLastNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithPhoneNumberTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CustomerTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CustomerUpdaterInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\CustomerRepository;
use Sylius\Component\Core\Model\Customer;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CustomerInterface>
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
final class CustomerFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithEmailTrait;
    use WithFirstNameTrait;
    use WithLastNameTrait;
    use MaleTrait;
    use FemaleTrait;
    use WithPhoneNumberTrait;
    use WithBirthdayTrait;

    private static ?string $modelClass = null;

    public function __construct(
        private FactoryInterface $factory,
        private CustomerDefaultValuesInterface $defaultValues,
        private CustomerTransformerInterface $transformer,
        private CustomerUpdaterInterface $updater,
    ) {
        parent::__construct();
    }

    public static function withModelClass(string $modelClass): void
    {
        self::$modelClass = $modelClass;
    }

    protected function getDefaults(): array
    {
        return $this->defaultValues->getDefaultValues(self::faker());
    }

    protected function initialize(): self
    {
        return $this
            ->beforeInstantiate(function (array $attributes): array {
                return $this->transformer->transform($attributes);
            })
            ->instantiateWith(function (): CustomerInterface {
                /** @var CustomerInterface $customer */
                $customer = $this->factory->createNew();

                return $customer;
            })
            ->afterInstantiate(function (CustomerInterface $customer, array $attributes): void {
                $this->updater->update($customer, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Customer::class;
    }
}
