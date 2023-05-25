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
use Sylius\Bundle\ProductBundle\Doctrine\ORM\ProductAssociationTypeRepository;
use Sylius\Component\Product\Model\ProductAssociationType;
use Sylius\Component\Product\Model\ProductAssociationTypeInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ProductAssociationTypeInterface>
 *
 * @method        ProductAssociationTypeInterface|Proxy create(array|callable $attributes = [])
 * @method static ProductAssociationTypeInterface|Proxy createOne(array $attributes = [])
 * @method static ProductAssociationTypeInterface|Proxy find(object|array|mixed $criteria)
 * @method static ProductAssociationTypeInterface|Proxy findOrCreate(array $attributes)
 * @method static ProductAssociationTypeInterface|Proxy first(string $sortedField = 'id')
 * @method static ProductAssociationTypeInterface|Proxy last(string $sortedField = 'id')
 * @method static ProductAssociationTypeInterface|Proxy random(array $attributes = [])
 * @method static ProductAssociationTypeInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductAssociationTypeRepository|RepositoryProxy repository()
 * @method static ProductAssociationTypeInterface[]|Proxy[] all()
 * @method static ProductAssociationTypeInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProductAssociationTypeInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ProductAssociationTypeInterface[]|Proxy[] findBy(array $attributes)
 * @method static ProductAssociationTypeInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductAssociationTypeInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProductAssociationTypeFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? ProductAssociationType::class;
    }
}
