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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithImagesTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithProductAttributesTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithShortDescriptionTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithSlugTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithTaxaTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithTaxCategoryTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ProductInterface>
 *
 * @method        ProductInterface|Proxy create(array|callable $attributes = [])
 * @method static ProductInterface|Proxy createOne(array $attributes = [])
 * @method static ProductInterface|Proxy find(object|array|mixed $criteria)
 * @method static ProductInterface|Proxy findOrCreate(array $attributes)
 * @method static ProductInterface|Proxy first(string $sortedField = 'id')
 * @method static ProductInterface|Proxy last(string $sortedField = 'id')
 * @method static ProductInterface|Proxy random(array $attributes = [])
 * @method static ProductInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductRepository|RepositoryProxy repository()
 * @method static ProductInterface[]|Proxy[] all()
 * @method static ProductInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProductInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ProductInterface[]|Proxy[] findBy(array $attributes)
 * @method static ProductInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProductFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithSlugTrait;
    use ToggableTrait;
    use WithDescriptionTrait;
    use WithShortDescriptionTrait;
    use WithChannelsTrait;
    use WithImagesTrait;
    use WithProductAttributesTrait;
    use WithTaxCategoryTrait;
    use WithTaxaTrait;

    public function tracked(): self
    {
        return $this->addState(['tracked' => true]);
    }

    public function untracked(): self
    {
        return $this->addState(['tracked' => false]);
    }

    public function withShippingRequired(): self
    {
        return $this->addState(['shippingRequired' => true]);
    }

    public function withShippingNotRequired(): self
    {
        return $this->addState(['shippingRequired' => false]);
    }

    public function withVariantSelectionMethod(string $variantSelectionMethod): self
    {
        return $this->addState(['variantSelectionMethod' => $variantSelectionMethod]);
    }

    public function withMainTaxon(Proxy|TaxonInterface|string $mainTaxon): self
    {
        return $this->addState(['mainTaxon' => $mainTaxon]);
    }

    public function withProductOptions(array $productOptions): self
    {
        return $this->addState(['productOptions' => $productOptions]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Product::class;
    }
}
