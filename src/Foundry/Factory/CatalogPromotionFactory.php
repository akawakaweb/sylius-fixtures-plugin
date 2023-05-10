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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Doctrine\ORM\EntityRepository;
use Sylius\Component\Core\Model\CatalogPromotion;
use Sylius\Component\Core\Model\CatalogPromotionInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<CatalogPromotionInterface>
 *
 * @method        CatalogPromotionInterface|Proxy create(array|callable $attributes = [])
 * @method static CatalogPromotionInterface|Proxy createOne(array $attributes = [])
 * @method static CatalogPromotionInterface|Proxy find(object|array|mixed $criteria)
 * @method static CatalogPromotionInterface|Proxy findOrCreate(array $attributes)
 * @method static CatalogPromotionInterface|Proxy first(string $sortedField = 'id')
 * @method static CatalogPromotionInterface|Proxy last(string $sortedField = 'id')
 * @method static CatalogPromotionInterface|Proxy random(array $attributes = [])
 * @method static CatalogPromotionInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static CatalogPromotionInterface[]|Proxy[] all()
 * @method static CatalogPromotionInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CatalogPromotionInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CatalogPromotionInterface[]|Proxy[] findBy(array $attributes)
 * @method static CatalogPromotionInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CatalogPromotionInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CatalogPromotionFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? CatalogPromotion::class;
    }
}
