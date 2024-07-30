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
use Sylius\Component\Promotion\Model\CatalogPromotionAction;
use Sylius\Component\Promotion\Model\CatalogPromotionActionInterface;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends AbstractModelFactory<CatalogPromotionActionInterface>
 *
 * @method        CatalogPromotionActionInterface|Proxy create(array|callable $attributes = [], bool $noProxy = false)
 * @method static CatalogPromotionActionInterface|Proxy createOne(array $attributes = [])
 * @method static CatalogPromotionActionInterface|Proxy find(object|array|mixed $criteria)
 * @method static CatalogPromotionActionInterface|Proxy findOrCreate(array $attributes)
 * @method static CatalogPromotionActionInterface|Proxy first(string $sortedField = 'id')
 * @method static CatalogPromotionActionInterface|Proxy last(string $sortedField = 'id')
 * @method static CatalogPromotionActionInterface|Proxy random(array $attributes = [])
 * @method static CatalogPromotionActionInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|ProxyRepositoryDecorator repository()
 * @method static CatalogPromotionActionInterface[]|Proxy[] all()
 * @method static CatalogPromotionActionInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CatalogPromotionActionInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CatalogPromotionActionInterface[]|Proxy[] findBy(array $attributes)
 * @method static CatalogPromotionActionInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CatalogPromotionActionInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CatalogPromotionActionFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;

    public function withType(string $type): self
    {
        return $this->with(['type' => $type]);
    }

    public function withConfiguration(array $configuration): self
    {
        return $this->with(['configuration' => $configuration]);
    }

    public static function class(): string
    {
        return self::$modelClass ?? CatalogPromotionAction::class;
    }
}
