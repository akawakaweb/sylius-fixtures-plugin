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
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithSlugTrait;
use Sylius\Bundle\TaxonomyBundle\Doctrine\ORM\TaxonRepository;
use Sylius\Component\Core\Model\Taxon;
use Sylius\Component\Core\Model\TaxonInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<TaxonInterface>
 *
 * @method        TaxonInterface|Proxy create(array|callable $attributes = [])
 * @method static TaxonInterface|Proxy createOne(array $attributes = [])
 * @method static TaxonInterface|Proxy find(object|array|mixed $criteria)
 * @method static TaxonInterface|Proxy findOrCreate(array $attributes)
 * @method static TaxonInterface|Proxy first(string $sortedField = 'id')
 * @method static TaxonInterface|Proxy last(string $sortedField = 'id')
 * @method static TaxonInterface|Proxy random(array $attributes = [])
 * @method static TaxonInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static TaxonRepository|RepositoryProxy repository()
 * @method static TaxonInterface[]|Proxy[] all()
 * @method static TaxonInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static TaxonInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static TaxonInterface[]|Proxy[] findBy(array $attributes)
 * @method static TaxonInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TaxonInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TaxonFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithSlugTrait;
    use WithDescriptionTrait;

    public function withTranslations(array $translations): self
    {
        return $this->addState(['translations' => $translations]);
    }

    public function withChildren(array $children): self
    {
        return $this->addState(['children' => $children]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Taxon::class;
    }
}
