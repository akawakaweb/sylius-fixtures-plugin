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
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Addressing\Model\ZoneMember;
use Sylius\Component\Addressing\Model\ZoneMemberInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ZoneMemberInterface>
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
final class ZoneMemberFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? ZoneMember::class;
    }
}
