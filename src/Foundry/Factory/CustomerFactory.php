<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CustomerDefaultValuesInterface;
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
 *
 * @phpstan-method        Proxy<CustomerInterface> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<CustomerInterface> createOne(array $attributes = [])
 * @phpstan-method static Proxy<CustomerInterface> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<CustomerInterface> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<CustomerInterface> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<CustomerInterface> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<CustomerInterface> random(array $attributes = [])
 * @phpstan-method static Proxy<CustomerInterface> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<CustomerInterface> repository()
 * @phpstan-method static list<Proxy<CustomerInterface>> all()
 * @phpstan-method static list<Proxy<CustomerInterface>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<CustomerInterface>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<CustomerInterface>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<CustomerInterface>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<CustomerInterface>> randomSet(int $number, array $attributes = [])
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
