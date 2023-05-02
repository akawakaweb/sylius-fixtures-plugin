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

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\CurrencyDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\CurrencyTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\CurrencyUpdaterInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Currency\Model\Currency;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CurrencyInterface>
 *
 * @method        CurrencyInterface|Proxy create(array|callable $attributes = [])
 * @method static CurrencyInterface|Proxy createOne(array $attributes = [])
 * @method static CurrencyInterface|Proxy find(object|array|mixed $criteria)
 * @method static CurrencyInterface|Proxy findOrCreate(array $attributes)
 * @method static CurrencyInterface|Proxy first(string $sortedField = 'id')
 * @method static CurrencyInterface|Proxy last(string $sortedField = 'id')
 * @method static CurrencyInterface|Proxy random(array $attributes = [])
 * @method static CurrencyInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static CurrencyInterface[]|Proxy[] all()
 * @method static CurrencyInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CurrencyInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CurrencyInterface[]|Proxy[] findBy(array $attributes)
 * @method static CurrencyInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CurrencyInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<CurrencyInterface> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<CurrencyInterface> createOne(array $attributes = [])
 * @phpstan-method static Proxy<CurrencyInterface> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<CurrencyInterface> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<CurrencyInterface> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<CurrencyInterface> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<CurrencyInterface> random(array $attributes = [])
 * @phpstan-method static Proxy<CurrencyInterface> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<CurrencyInterface> repository()
 * @phpstan-method static list<Proxy<CurrencyInterface>> all()
 * @phpstan-method static list<Proxy<CurrencyInterface>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<CurrencyInterface>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<CurrencyInterface>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<CurrencyInterface>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<CurrencyInterface>> randomSet(int $number, array $attributes = [])
 */
final class CurrencyFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithCodeTrait;

    private static ?string $modelClass = null;

    public function __construct(
        private FactoryInterface $factory,
        private CurrencyDefaultValuesInterface $defaultValues,
        private CurrencyTransformerInterface $transformer,
        private CurrencyUpdaterInterface $updater,
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
            ->instantiateWith(function (): CurrencyInterface {
                /** @var CurrencyInterface $currency */
                $currency = $this->factory->createNew();

                return $currency;
            })
            ->afterInstantiate(function (CurrencyInterface $currency, array $attributes): void {
                $this->updater->update($currency, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Currency::class;
    }
}
