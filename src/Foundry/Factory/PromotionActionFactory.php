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
use Sylius\Component\Promotion\Model\PromotionAction;
use Sylius\Component\Promotion\Model\PromotionActionInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<PromotionActionInterface>
 *
 * @method        PromotionActionInterface|Proxy create(array|callable $attributes = [])
 * @method static PromotionActionInterface|Proxy createOne(array $attributes = [])
 * @method static PromotionActionInterface|Proxy find(object|array|mixed $criteria)
 * @method static PromotionActionInterface|Proxy findOrCreate(array $attributes)
 * @method static PromotionActionInterface|Proxy first(string $sortedField = 'id')
 * @method static PromotionActionInterface|Proxy last(string $sortedField = 'id')
 * @method static PromotionActionInterface|Proxy random(array $attributes = [])
 * @method static PromotionActionInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static PromotionActionInterface[]|Proxy[] all()
 * @method static PromotionActionInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PromotionActionInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static PromotionActionInterface[]|Proxy[] findBy(array $attributes)
 * @method static PromotionActionInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PromotionActionInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PromotionActionFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
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
        return self::$modelClass ?? PromotionAction::class;
    }
}
