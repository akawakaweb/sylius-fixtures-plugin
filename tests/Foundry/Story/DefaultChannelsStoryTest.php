<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultChannelsStory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultMenuTaxonStory;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultChannelsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_default_channels(): void
    {
        self::bootKernel();

        DefaultChannelsStory::load();

        $channels = $this->getChannelRepository()->findAll();

        $this->assertCount(1, $channels);

        $channel = $channels[0];
        $this->assertInstanceOf(ChannelInterface::class, $channel);
        $this->assertEquals('FASHION_WEB', $channel->getCode());
    }

    private function getChannelRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.channel');
    }
}
