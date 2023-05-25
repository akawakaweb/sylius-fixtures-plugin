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
use Sylius\Component\Promotion\Model\PromotionRule;
use Sylius\Component\Promotion\Model\PromotionRuleInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<PromotionRuleInterface>
 *
 * @method        PromotionRuleInterface|Proxy create(array|callable $attributes = [])
 * @method static PromotionRuleInterface|Proxy createOne(array $attributes = [])
 * @method static PromotionRuleInterface|Proxy find(object|array|mixed $criteria)
 * @method static PromotionRuleInterface|Proxy findOrCreate(array $attributes)
 * @method static PromotionRuleInterface|Proxy first(string $sortedField = 'id')
 * @method static PromotionRuleInterface|Proxy last(string $sortedField = 'id')
 * @method static PromotionRuleInterface|Proxy random(array $attributes = [])
 * @method static PromotionRuleInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static PromotionRuleInterface[]|Proxy[] all()
 * @method static PromotionRuleInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PromotionRuleInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static PromotionRuleInterface[]|Proxy[] findBy(array $attributes)
 * @method static PromotionRuleInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PromotionRuleInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PromotionRuleFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
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
        return self::$modelClass ?? PromotionRule::class;
    }
}
