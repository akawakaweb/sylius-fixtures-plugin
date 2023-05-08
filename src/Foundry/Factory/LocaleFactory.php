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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Locale\Model\Locale;
use Sylius\Component\Locale\Model\LocaleInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<LocaleInterface>
 *
 * @method        LocaleInterface|Proxy create(array|callable $attributes = [])
 * @method static LocaleInterface|Proxy createOne(array $attributes = [])
 * @method static LocaleInterface|Proxy find(object|array|mixed $criteria)
 * @method static LocaleInterface|Proxy findOrCreate(array $attributes)
 * @method static LocaleInterface|Proxy first(string $sortedField = 'id')
 * @method static LocaleInterface|Proxy last(string $sortedField = 'id')
 * @method static LocaleInterface|Proxy random(array $attributes = [])
 * @method static LocaleInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static LocaleInterface[]|Proxy[] all()
 * @method static LocaleInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static LocaleInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static LocaleInterface[]|Proxy[] findBy(array $attributes)
 * @method static LocaleInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LocaleInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class LocaleFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? Locale::class;
    }
}
