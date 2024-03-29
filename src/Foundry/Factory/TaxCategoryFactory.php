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

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Doctrine\ORM\EntityRepository;
use Sylius\Component\Taxation\Model\TaxCategory;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<TaxCategoryInterface>
 *
 * @method        TaxCategoryInterface|Proxy create(array|callable $attributes = [])
 * @method static TaxCategoryInterface|Proxy createOne(array $attributes = [])
 * @method static TaxCategoryInterface|Proxy find(object|array|mixed $criteria)
 * @method static TaxCategoryInterface|Proxy findOrCreate(array $attributes)
 * @method static TaxCategoryInterface|Proxy first(string $sortedField = 'id')
 * @method static TaxCategoryInterface|Proxy last(string $sortedField = 'id')
 * @method static TaxCategoryInterface|Proxy random(array $attributes = [])
 * @method static TaxCategoryInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static TaxCategoryInterface[]|Proxy[] all()
 * @method static TaxCategoryInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static TaxCategoryInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static TaxCategoryInterface[]|Proxy[] findBy(array $attributes)
 * @method static TaxCategoryInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TaxCategoryInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TaxCategoryFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithDescriptionTrait;

    protected static function getClass(): string
    {
        return self::$modelClass ?? TaxCategory::class;
    }
}
