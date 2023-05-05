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

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ZoneMemberDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneMemberTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ZoneMemberUpdaterInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Addressing\Model\ZoneMember;
use Sylius\Component\Addressing\Model\ZoneMemberInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ZoneMemberInterface>
 *
 * @method        ZoneMemberInterface|Proxy create(array|callable $attributes = [])
 * @method static ZoneMemberInterface|Proxy createOne(array $attributes = [])
 * @method static ZoneMemberInterface|Proxy find(object|array|mixed $criteria)
 * @method static ZoneMemberInterface|Proxy findOrCreate(array $attributes)
 * @method static ZoneMemberInterface|Proxy first(string $sortedField = 'id')
 * @method static ZoneMemberInterface|Proxy last(string $sortedField = 'id')
 * @method static ZoneMemberInterface|Proxy random(array $attributes = [])
 * @method static ZoneMemberInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static ZoneMemberInterface[]|Proxy[] all()
 * @method static ZoneMemberInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ZoneMemberInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ZoneMemberInterface[]|Proxy[] findBy(array $attributes)
 * @method static ZoneMemberInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ZoneMemberInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ZoneMemberFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;

    public function __construct(
        private FactoryInterface $factory,
        private ZoneMemberDefaultValuesInterface $defaultValues,
        private ZoneMemberTransformerInterface $transformer,
        private ZoneMemberUpdaterInterface $updater,
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
            ->instantiateWith(function (): ZoneMemberInterface {
                /** @var ZoneMemberInterface $zoneMember */
                $zoneMember = $this->factory->createNew();

                return $zoneMember;
            })
            ->afterInstantiate(function (ZoneMemberInterface $zoneMember, array $attributes): void {
                $this->updater->update($zoneMember, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? ZoneMember::class;
    }
}
