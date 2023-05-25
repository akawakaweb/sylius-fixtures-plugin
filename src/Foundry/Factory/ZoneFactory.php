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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Addressing\Model\Zone;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ZoneInterface>
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
final class ZoneFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;

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

    protected static function getClass(): string
    {
        return self::$modelClass ?? Zone::class;
    }
}
