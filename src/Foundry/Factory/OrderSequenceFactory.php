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

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Core\Model\OrderSequence;
use Sylius\Component\Core\Model\OrderSequenceInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<OrderSequenceInterface>
 *
 * @method        OrderSequenceInterface|Proxy create(array|callable $attributes = [])
 * @method static OrderSequenceInterface|Proxy createOne(array $attributes = [])
 * @method static OrderSequenceInterface|Proxy find(object|array|mixed $criteria)
 * @method static OrderSequenceInterface|Proxy findOrCreate(array $attributes)
 * @method static OrderSequenceInterface|Proxy first(string $sortedField = 'id')
 * @method static OrderSequenceInterface|Proxy last(string $sortedField = 'id')
 * @method static OrderSequenceInterface|Proxy random(array $attributes = [])
 * @method static OrderSequenceInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static OrderSequenceInterface[]|Proxy[] all()
 * @method static OrderSequenceInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static OrderSequenceInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static OrderSequenceInterface[]|Proxy[] findBy(array $attributes)
 * @method static OrderSequenceInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static OrderSequenceInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class OrderSequenceFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;

    protected function getDefaults(): array
    {
        return [];
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? OrderSequence::class;
    }
}
