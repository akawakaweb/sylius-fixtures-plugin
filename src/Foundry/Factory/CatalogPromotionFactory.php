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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\ToggableTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithChannelsTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithPriorityTrait;
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
    use WithDescriptionTrait;
    use WithChannelsTrait;
    use WithPriorityTrait;
    use ToggableTrait;

    public function withLabel(string $label): self
    {
        return $this->addState(['label' => $label]);
    }

    public function withScopes(array $scopes): self
    {
        return $this->addState(['scopes' => $scopes]);
    }

    public function withActions(array $actions): self
    {
        return $this->addState(['actions' => $actions]);
    }

    public function exclusive(): self
    {
        return $this->addState(['exclusive' => true]);
    }

    public function notExclusive(): self
    {
        return $this->addState(['exclusive' => false]);
    }

    public function withStartDate(\DateTimeInterface|string $startDate): self
    {
        return $this->addState(['startDate' => $startDate]);
    }

    public function withEndDate(\DateTimeInterface|string $endDate): self
    {
        return $this->addState(['endDate' => $endDate]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? CatalogPromotion::class;
    }
}
