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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\ToggableTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithZoneTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ShippingMethodRepository;
use Sylius\Component\Core\Model\ShippingMethod;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Shipping\Model\ShippingCategoryInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ShippingMethodInterface>
 *
 * @method        ShippingMethodInterface|Proxy create(array|callable $attributes = [])
 * @method static ShippingMethodInterface|Proxy createOne(array $attributes = [])
 * @method static ShippingMethodInterface|Proxy find(object|array|mixed $criteria)
 * @method static ShippingMethodInterface|Proxy findOrCreate(array $attributes)
 * @method static ShippingMethodInterface|Proxy first(string $sortedField = 'id')
 * @method static ShippingMethodInterface|Proxy last(string $sortedField = 'id')
 * @method static ShippingMethodInterface|Proxy random(array $attributes = [])
 * @method static ShippingMethodInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static ShippingMethodRepository|RepositoryProxy repository()
 * @method static ShippingMethodInterface[]|Proxy[] all()
 * @method static ShippingMethodInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ShippingMethodInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ShippingMethodInterface[]|Proxy[] findBy(array $attributes)
 * @method static ShippingMethodInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ShippingMethodInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ShippingMethodFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithDescriptionTrait;
    use WithZoneTrait;
    use ToggableTrait;

    public function withCategory(Proxy|ShippingCategoryInterface|string $category): self
    {
        return $this->addState(['category' => $category]);
    }

    public function withArchiveDate(\DateTimeInterface $archivedAt): self
    {
        return $this->addState(['archivedAt' => $archivedAt]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? ShippingMethod::class;
    }
}
