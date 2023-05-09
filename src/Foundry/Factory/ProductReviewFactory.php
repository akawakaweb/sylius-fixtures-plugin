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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCommentTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithStatusTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithTitleTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductReviewRepository;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductReview;
use Sylius\Component\Review\Model\ReviewerInterface;
use Sylius\Component\Review\Model\ReviewInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ReviewInterface>
 *
 * @method        ReviewInterface|Proxy create(array|callable $attributes = [])
 * @method static ReviewInterface|Proxy createOne(array $attributes = [])
 * @method static ReviewInterface|Proxy find(object|array|mixed $criteria)
 * @method static ReviewInterface|Proxy findOrCreate(array $attributes)
 * @method static ReviewInterface|Proxy first(string $sortedField = 'id')
 * @method static ReviewInterface|Proxy last(string $sortedField = 'id')
 * @method static ReviewInterface|Proxy random(array $attributes = [])
 * @method static ReviewInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductReviewRepository|RepositoryProxy repository()
 * @method static ReviewInterface[]|Proxy[] all()
 * @method static ReviewInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ReviewInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ReviewInterface[]|Proxy[] findBy(array $attributes)
 * @method static ReviewInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ReviewInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProductReviewFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithTitleTrait;
    use WithCommentTrait;
    use WithStatusTrait;

    public function withRating(int $rating): self
    {
        return $this->addState(['rating' => $rating]);
    }

    public function withAuthor(Proxy|ReviewerInterface|string $author): self
    {
        return $this->addState(['author' => $author]);
    }

    public function withReviewSubject(Proxy|ProductInterface|string $reviewSubject): self
    {
        return $this->addState(['reviewSubject' => $reviewSubject]);
    }

    protected static function getClass(): string
    {
        return ProductReview::class;
    }
}
