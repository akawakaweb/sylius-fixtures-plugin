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

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ShopUserDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\FemaleTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\MaleTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithBirthdayTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithEmailTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithFirstNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithLastNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithPasswordTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithPhoneNumberTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ShopUserTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ShopUserUpdaterInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\UserRepository;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\ShopUser;
use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ShopUserInterface>
 *
 * @method        ShopUserInterface|Proxy create(array|callable $attributes = [])
 * @method static ShopUserInterface|Proxy createOne(array $attributes = [])
 * @method static ShopUserInterface|Proxy find(object|array|mixed $criteria)
 * @method static ShopUserInterface|Proxy findOrCreate(array $attributes)
 * @method static ShopUserInterface|Proxy first(string $sortedField = 'id')
 * @method static ShopUserInterface|Proxy last(string $sortedField = 'id')
 * @method static ShopUserInterface|Proxy random(array $attributes = [])
 * @method static ShopUserInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method static ShopUserInterface[]|Proxy[] all()
 * @method static ShopUserInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ShopUserInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ShopUserInterface[]|Proxy[] findBy(array $attributes)
 * @method static ShopUserInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ShopUserInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ShopUserFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithEmailTrait;
    use WithFirstNameTrait;
    use WithLastNameTrait;
    use WithPasswordTrait;
    use MaleTrait;
    use FemaleTrait;
    use WithPhoneNumberTrait;
    use WithBirthdayTrait;

    public function __construct(
        private FactoryInterface $shopUserFactory,
        private FactoryInterface $customerFactory,
        private ShopUserDefaultValuesInterface $defaultValues,
        private ShopUserTransformerInterface $transformer,
        private ShopUserUpdaterInterface $updater,
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
            ->instantiateWith(function (): ShopUserInterface {
                /** @var ShopUserInterface $shopUser */
                $shopUser = $this->shopUserFactory->createNew();

                /** @var CustomerInterface $customer */
                $customer = $this->customerFactory->createNew();

                $shopUser->setCustomer($customer);

                return $shopUser;
            })
            ->afterInstantiate(function (ShopUserInterface $shopUser, array $attributes): void {
                $this->updater->update($shopUser, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? ShopUser::class;
    }
}
