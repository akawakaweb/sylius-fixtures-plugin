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
use Sylius\Component\Currency\Model\Currency;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<CurrencyInterface>
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
 */
final class CurrencyFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? Currency::class;
    }
}
