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

use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductAssociationRepository;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Product\Model\ProductAssociation;
use Sylius\Component\Product\Model\ProductAssociationInterface;
use Sylius\Component\Product\Model\ProductAssociationTypeInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ProductAssociation>
 *
 * @method        ProductAssociationInterface|Proxy create(array|callable $attributes = [])
 * @method static ProductAssociationInterface|Proxy createOne(array $attributes = [])
 * @method static ProductAssociationInterface|Proxy find(object|array|mixed $criteria)
 * @method static ProductAssociationInterface|Proxy findOrCreate(array $attributes)
 * @method static ProductAssociationInterface|Proxy first(string $sortedField = 'id')
 * @method static ProductAssociationInterface|Proxy last(string $sortedField = 'id')
 * @method static ProductAssociationInterface|Proxy random(array $attributes = [])
 * @method static ProductAssociationInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductAssociationRepository|RepositoryProxy repository()
 * @method static ProductAssociationInterface[]|Proxy[] all()
 * @method static ProductAssociationInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProductAssociationInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ProductAssociationInterface[]|Proxy[] findBy(array $attributes)
 * @method static ProductAssociationInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductAssociationInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProductAssociationFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;

    public function withType(Proxy|ProductAssociationTypeInterface|string $type): self
    {
        return $this->addState(['type' => $type]);
    }

    public function withOwner(Proxy|ProductInterface|string $owner): self
    {
        return $this->addState(['owner' => $owner]);
    }

    public function withAssociatedProducts(array $associatedProducts): self
    {
        return $this->addState(['associatedProducts' => $associatedProducts]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? ProductAssociation::class;
    }
}
