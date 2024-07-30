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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithChannelsTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithPriorityTrait;
use Doctrine\ORM\EntityRepository;
use Sylius\Component\Core\Model\Promotion;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends AbstractModelFactory<Promotion>
 *
 * @method        Promotion|Proxy create(array|callable $attributes = [], bool $noProxy = false)
 * @method static Promotion|Proxy createOne(array $attributes = [])
 * @method static Promotion|Proxy find(object|array|mixed $criteria)
 * @method static Promotion|Proxy findOrCreate(array $attributes)
 * @method static Promotion|Proxy first(string $sortedField = 'id')
 * @method static Promotion|Proxy last(string $sortedField = 'id')
 * @method static Promotion|Proxy random(array $attributes = [])
 * @method static Promotion|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|ProxyRepositoryDecorator repository()
 * @method static Promotion[]|Proxy[] all()
 * @method static Promotion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Promotion[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Promotion[]|Proxy[] findBy(array $attributes)
 * @method static Promotion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Promotion[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PromotionFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithDescriptionTrait;
    use WithPriorityTrait;
    use WithChannelsTrait;

    public function withUsageLimit(int $usageLimit): self
    {
        return $this->with(['usageLimit' => $usageLimit]);
    }

    public function couponBased(): self
    {
        return $this->with(['couponBased' => true]);
    }

    public function notCouponBased(): self
    {
        return $this->with(['couponBased' => false]);
    }

    public function exclusive(): self
    {
        return $this->with(['exclusive' => true]);
    }

    public function notExclusive(): self
    {
        return $this->with(['exclusive' => false]);
    }

    public function withStartDate(\DateTimeInterface|string $startAt): self
    {
        return $this->with(['startsAt' => $startAt]);
    }

    public function withEndDate(\DateTimeInterface|string $endAt): self
    {
        return $this->with(['endsAt' => $endAt]);
    }

    public function withRules(array $rules): self
    {
        return $this->with(['rules' => $rules]);
    }

    public function withActions(array $actions): self
    {
        return $this->with(['actions' => $actions]);
    }

    public function withCoupons(array $coupons): self
    {
        return $this->with(['coupons' => $coupons]);
    }

    public function defaults(): array
    {
        return [
            'appliesToDiscounted' => self::faker()->boolean(),
            'code' => self::faker()->text(),
            'couponBased' => self::faker()->boolean(),
            'createdAt' => self::faker()->dateTime(),
            'exclusive' => self::faker()->boolean(),
            'name' => self::faker()->text(),
            'priority' => self::faker()->randomNumber(),
            'used' => self::faker()->randomNumber(),
        ];
    }

    public static function class(): string
    {
        return self::$modelClass ?? Promotion::class;
    }
}
