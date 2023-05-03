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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TaxCategoryTransformerInterface;
use Doctrine\ORM\EntityRepository;
use Sylius\Component\Taxation\Model\TaxCategory;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<TaxCategoryInterface>
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
final class TaxCategoryFactory extends ModelFactory
{
    use WithCodeTrait;
    use WithNameTrait;
    use WithDescriptionTrait;

    public function __construct(
        private TaxCategoryTransformerInterface $transformer,
    ) {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'createdAt' => self::faker()->dateTime(),
            'name' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->beforeInstantiate(function (array $attributes): array {
                return $this->transformer->transform($attributes);
            })
            // ->afterInstantiate(function(TaxCategory $taxCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return TaxCategory::class;
    }
}
