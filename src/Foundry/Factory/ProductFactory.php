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

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\ProductDefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\ToggableTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithChannelsTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithImagesTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithProductAttributesTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithShortDescriptionTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithSlugTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithTaxCategoryTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\ProductTransformerInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\ProductUpdaterInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ProductInterface>
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
final class ProductFactory extends ModelFactory implements FactoryWithModelClassAwareInterface
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

    public function __construct(
        private FactoryInterface $factory,
        private ProductDefaultValuesInterface $defaultValues,
        private ProductTransformerInterface $transformer,
        private ProductUpdaterInterface $updater,
    ) {
        parent::__construct();
    }

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

    protected function getDefaults(): array
    {
        return $this->defaultValues->getDefaultValues(self::faker());
    }

    protected function initialize(): self
    {
        return $this
            ->beforeInstantiate(function (array $attributes): array {
                return $this->transformer->transform($attributes);
            })
            ->instantiateWith(function (): ProductInterface {
                /** @var ProductInterface $product */
                $product = $this->factory->createNew();

                return $product;
            })
            ->afterInstantiate(function (Product $product, array $attributes): void {
                $this->updater->update($product, $attributes);
            })
        ;
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Product::class;
    }
}
