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

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Core\Model\CatalogPromotionScope;
use Sylius\Component\Core\Model\CatalogPromotionScopeInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<CatalogPromotionScopeInterface>
 *
 * @method        CatalogPromotionScopeInterface|Proxy create(array|callable $attributes = [])
 * @method static CatalogPromotionScopeInterface|Proxy createOne(array $attributes = [])
 * @method static CatalogPromotionScopeInterface|Proxy find(object|array|mixed $criteria)
 * @method static CatalogPromotionScopeInterface|Proxy findOrCreate(array $attributes)
 * @method static CatalogPromotionScopeInterface|Proxy first(string $sortedField = 'id')
 * @method static CatalogPromotionScopeInterface|Proxy last(string $sortedField = 'id')
 * @method static CatalogPromotionScopeInterface|Proxy random(array $attributes = [])
 * @method static CatalogPromotionScopeInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static CatalogPromotionScopeInterface[]|Proxy[] all()
 * @method static CatalogPromotionScopeInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CatalogPromotionScopeInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CatalogPromotionScopeInterface[]|Proxy[] findBy(array $attributes)
 * @method static CatalogPromotionScopeInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CatalogPromotionScopeInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CatalogPromotionScopeFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;

    public function withType(string $type): self
    {
        return $this->addState(['type' => $type]);
    }

    public function withConfiguration(array $configuration): self
    {
        return $this->addState(['configuration' => $configuration]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? CatalogPromotionScope::class;
    }
}
