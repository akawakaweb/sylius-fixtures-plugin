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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\RandomProductReviewsStory;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomProductReviewsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_product_reviews(): void
    {
        self::bootKernel();

        LocaleFactory::new()->withCode('en_US')->create();
        RandomProductReviewsStory::load();

        $productReviews = $this->getProductReviewRepository()->findAll();
        $products = $this->getProductRepository()->findAll();
        $customers = $this->getCustomerRepository()->findAll();

        $this->assertCount(40, $productReviews);
        $this->assertCount(1, $products);
        $this->assertCount(1, $customers);
    }

    private function getCustomerRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.customer');
    }

    private function getProductRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product');
    }

    private function getProductReviewRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product_review');
    }
}
