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

use Sylius\Bundle\PromotionBundle\Doctrine\ORM\PromotionCouponRepository;
use Sylius\Component\Core\Model\PromotionCoupon;
use Sylius\Component\Core\Model\PromotionCouponInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<PromotionCouponInterface>
 *
 * @method        PromotionCouponInterface|Proxy create(array|callable $attributes = [])
 * @method static PromotionCouponInterface|Proxy createOne(array $attributes = [])
 * @method static PromotionCouponInterface|Proxy find(object|array|mixed $criteria)
 * @method static PromotionCouponInterface|Proxy findOrCreate(array $attributes)
 * @method static PromotionCouponInterface|Proxy first(string $sortedField = 'id')
 * @method static PromotionCouponInterface|Proxy last(string $sortedField = 'id')
 * @method static PromotionCouponInterface|Proxy random(array $attributes = [])
 * @method static PromotionCouponInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static PromotionCouponRepository|RepositoryProxy repository()
 * @method static PromotionCouponInterface[]|Proxy[] all()
 * @method static PromotionCouponInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PromotionCouponInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static PromotionCouponInterface[]|Proxy[] findBy(array $attributes)
 * @method static PromotionCouponInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PromotionCouponInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PromotionCouponFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? PromotionCoupon::class;
    }
}
