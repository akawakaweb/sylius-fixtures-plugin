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

namespace Tests\Akawakaweb\SyliusFixturesPlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\CustomerFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductFactory;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\ProductReviewFactory;
use Sylius\Component\Review\Model\ReviewInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class ProductReviewFactoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_product_review_with_default_values(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $productReview = ProductReviewFactory::createOne();

        $this->assertInstanceOf(ReviewInterface::class, $productReview->object());
        //$this->assertNotNull($productReview->getTitle());
        $this->assertNotNull($productReview->getRating());
        //$this->assertNotNull($productReview->getComment());
        $this->assertNotNull($productReview->getReviewSubject());
        $this->assertNotNull($productReview->getAuthor());
        $this->assertNotNull($productReview->getStatus());
    }

    /** @test */
    public function it_creates_product_review_with_given_title(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $productReview = ProductReviewFactory::new()->withTitle('One ring to rule them all')->create();

        $this->assertEquals('One ring to rule them all', $productReview->getTitle());
    }

    /** @test */
    public function it_creates_product_review_with_given_rating(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $productReview = ProductReviewFactory::new()->withRating(5)->create();

        $this->assertEquals(5, $productReview->getRating());
    }

    /** @test */
    public function it_creates_product_review_with_given_comment(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $productReview = ProductReviewFactory::new()->withComment('You should not pass.')->create();

        $this->assertEquals('You should not pass.', $productReview->getComment());
    }

    /** @test */
    public function it_creates_product_review_with_given_author_as_proxy(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $author = CustomerFactory::createOne();
        $productReview = ProductReviewFactory::new()->withAuthor($author)->create();

        $this->assertEquals($author->object(), $productReview->getAuthor());
    }

    /** @test */
    public function it_creates_product_review_with_given_author(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $author = CustomerFactory::createOne()->object();
        $productReview = ProductReviewFactory::new()->withAuthor($author)->create();

        $this->assertEquals($author, $productReview->getAuthor());
    }

//    /** @test */
//    function it_creates_product_review_with_given_author_as_string(): void
//    {
//        LocaleFactory::new()->withCode('en_US')->create();
//        $productReview = ProductReviewFactory::new()->withAuthor('jrr.tokien@lotr.com')->create();
//
//        $this->assertEquals('jrr.tokien@lotr.com', $productReview->getAuthor());
//    }

    /** @test */
    public function it_creates_product_review_with_given_product_as_proxy(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $product = ProductFactory::createOne();
        $productReview = ProductReviewFactory::new()->withReviewSubject($product)->create();

        $this->assertEquals($product->object(), $productReview->getReviewSubject());
    }

    /** @test */
    public function it_creates_product_review_with_given_product(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $product = ProductFactory::createOne()->object();
        $productReview = ProductReviewFactory::new()->withReviewSubject($product)->create();

        $this->assertEquals($product, $productReview->getReviewSubject());
    }

//    /** @test */
//    function it_creates_product_review_with_given_product_as_string(): void
//    {
//        LocaleFactory::new()->withCode('en_US')->create();
//        $productReview = ProductReviewFactory::new()->withReviewSubject('Lord_Of_The_Rings_Book')->create();
//
//        $this->assertEquals('Lord_Of_The_Rings_Book', $productReview->getReviewSubject()->getCode());
//    }

    /** @test */
    public function it_creates_product_review_with_new_status(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $productReview = ProductReviewFactory::new()->withStatus('new')->create();

        $this->assertEquals('new', $productReview->getStatus());
    }

    /** @test */
    public function it_creates_product_review_with_rejected_status(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $productReview = ProductReviewFactory::new()->withStatus('rejected')->create();

        $this->assertEquals('rejected', $productReview->getStatus());
    }

    /** @test */
    public function it_creates_product_review_with_accepted_status(): void
    {
        LocaleFactory::new()->withCode('en_US')->create();
        $productReview = ProductReviewFactory::new()->withStatus('accepted')->create();

        $this->assertEquals('accepted', $productReview->getStatus());
    }
}
