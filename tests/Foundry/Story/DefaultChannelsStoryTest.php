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

namespace Tests\Akawakaweb\SyliusFixturesPlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Story\DefaultChannelsStory;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Akawakaweb\SyliusFixturesPlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultChannelsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_default_channels(): void
    {
        self::bootKernel();

        DefaultChannelsStory::load();

        $channels = $this->getChannelRepository()->findAll();

        $this->assertCount(1, $channels);

        $channel = $channels[0];
        $this->assertInstanceOf(ChannelInterface::class, $channel);
        $this->assertEquals('FASHION_WEB', $channel->getCode());
        $this->assertEquals('Fashion Web Store', $channel->getName());
        $this->assertEquals('en_US', $channel->getLocales()->first()->getCode());
        $this->assertEquals('localhost', $channel->getHostname());
        $this->assertNull($channel->getThemeName());
        $this->assertEquals('MENU_CATEGORY', $channel->getMenuTaxon()->getCode());
        $this->assertEquals('+41 123 456 789', $channel->getContactPhoneNumber());
        $this->assertEquals('contact@example.com', $channel->getContactEmail());
        $this->assertNotNull($channel->getShopBillingData());
    }

    private function getChannelRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.channel');
    }
}
