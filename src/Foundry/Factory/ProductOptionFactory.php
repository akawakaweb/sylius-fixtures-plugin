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
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductOptionRepository;
use Sylius\Component\Product\Model\ProductOption;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ProductOptionInterface>
 *
 * @method        ProductOptionInterface|Proxy create(array|callable $attributes = [])
 * @method static ProductOptionInterface|Proxy createOne(array $attributes = [])
 * @method static ProductOptionInterface|Proxy find(object|array|mixed $criteria)
 * @method static ProductOptionInterface|Proxy findOrCreate(array $attributes)
 * @method static ProductOptionInterface|Proxy first(string $sortedField = 'id')
 * @method static ProductOptionInterface|Proxy last(string $sortedField = 'id')
 * @method static ProductOptionInterface|Proxy random(array $attributes = [])
 * @method static ProductOptionInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductOptionRepository|RepositoryProxy repository()
 * @method static ProductOptionInterface[]|Proxy[] all()
 * @method static ProductOptionInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProductOptionInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ProductOptionInterface[]|Proxy[] findBy(array $attributes)
 * @method static ProductOptionInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductOptionInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProductOptionFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;

    public function withValues(array $values): self
    {
        return $this->addState(['values' => $values]);
    }

    protected function getDefaults(): array
    {
        return [
            'code' => self::faker()->text(),
            'createdAt' => self::faker()->dateTime(),
        ];
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? ProductOption::class;
    }
}
