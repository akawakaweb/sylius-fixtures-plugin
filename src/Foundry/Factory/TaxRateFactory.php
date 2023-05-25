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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithZoneTrait;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Core\Model\TaxRate;
use Sylius\Component\Core\Model\TaxRateInterface;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<TaxRateInterface>
 *
 * @method        TaxRateInterface|Proxy create(array|callable $attributes = [])
 * @method static TaxRateInterface|Proxy createOne(array $attributes = [])
 * @method static TaxRateInterface|Proxy find(object|array|mixed $criteria)
 * @method static TaxRateInterface|Proxy findOrCreate(array $attributes)
 * @method static TaxRateInterface|Proxy first(string $sortedField = 'id')
 * @method static TaxRateInterface|Proxy last(string $sortedField = 'id')
 * @method static TaxRateInterface|Proxy random(array $attributes = [])
 * @method static TaxRateInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static TaxRateInterface[]|Proxy[] all()
 * @method static TaxRateInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static TaxRateInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static TaxRateInterface[]|Proxy[] findBy(array $attributes)
 * @method static TaxRateInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TaxRateInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TaxRateFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithZoneTrait;

    public function withAmount(float $amount): self
    {
        return $this->addState(['amount' => $amount]);
    }

    public function includedInPrice(): self
    {
        return $this->addState(['included_in_price' => true]);
    }

    public function notIncludedInPrice(): self
    {
        return $this->addState(['included_in_price' => false]);
    }

    public function withCalculator(string $calculator): self
    {
        return $this->addState(['calculator' => $calculator]);
    }

    public function withCategory(Proxy|TaxCategoryInterface|string $category): self
    {
        return $this->addState(['category' => $category]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? TaxRate::class;
    }
}
