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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\ToggableTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Addressing\Model\Country;
use Sylius\Component\Addressing\Model\CountryInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<CountryInterface>
 *
 * @method        CountryInterface|Proxy create(array|callable $attributes = [])
 * @method static CountryInterface|Proxy createOne(array $attributes = [])
 * @method static CountryInterface|Proxy find(object|array|mixed $criteria)
 * @method static CountryInterface|Proxy findOrCreate(array $attributes)
 * @method static CountryInterface|Proxy first(string $sortedField = 'id')
 * @method static CountryInterface|Proxy last(string $sortedField = 'id')
 * @method static CountryInterface|Proxy random(array $attributes = [])
 * @method static CountryInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static CountryInterface[]|Proxy[] all()
 * @method static CountryInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CountryInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CountryInterface[]|Proxy[] findBy(array $attributes)
 * @method static CountryInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CountryInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CountryFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use ToggableTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? Country::class;
    }
}
