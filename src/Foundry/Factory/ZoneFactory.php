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

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ZoneDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ZoneTransformerInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Addressing\Model\Zone;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ZoneInterface>
 *
 * @method        ZoneInterface|Proxy create(array|callable $attributes = [])
 * @method static ZoneInterface|Proxy createOne(array $attributes = [])
 * @method static ZoneInterface|Proxy find(object|array|mixed $criteria)
 * @method static ZoneInterface|Proxy findOrCreate(array $attributes)
 * @method static ZoneInterface|Proxy first(string $sortedField = 'id')
 * @method static ZoneInterface|Proxy last(string $sortedField = 'id')
 * @method static ZoneInterface|Proxy random(array $attributes = [])
 * @method static ZoneInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static ZoneInterface[]|Proxy[] all()
 * @method static ZoneInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ZoneInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ZoneInterface[]|Proxy[] findBy(array $attributes)
 * @method static ZoneInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ZoneInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ZoneFactory extends ModelFactory
{
    use WithCodeTrait;
    use WithNameTrait;

    public function __construct(
        private ZoneDefaultValuesInterface $defaultValues,
        private ZoneTransformerInterface $transformer,
    ) {
        parent::__construct();
    }

    public function withMembers(array $members, string $type = ZoneInterface::TYPE_ZONE): self
    {
        return $this->addState([
            'type' => $type,
            'members' => $members,
        ]);
    }

    public function withCountries(array $countries): self
    {
        return $this->withMembers($countries, ZoneInterface::TYPE_COUNTRY);
    }

    public function withProvinces(array $countries): self
    {
        return $this->withMembers($countries, ZoneInterface::TYPE_PROVINCE);
    }

    public function withScope(string $scope): self
    {
        return $this->addState(['scope' => $scope]);
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
        ;
    }

    protected static function getClass(): string
    {
        return Zone::class;
    }
}
