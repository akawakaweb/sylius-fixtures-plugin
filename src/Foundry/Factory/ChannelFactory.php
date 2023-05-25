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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithCurrenciesTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithLocalesTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Doctrine\ORM\EntityRepository;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\Channel;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShopBillingDataInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends AbstractModelFactory<ChannelInterface>
 *
 * @method        ChannelInterface|Proxy create(array|callable $attributes = [])
 * @method static ChannelInterface|Proxy createOne(array $attributes = [])
 * @method static ChannelInterface|Proxy find(object|array|mixed $criteria)
 * @method static ChannelInterface|Proxy findOrCreate(array $attributes)
 * @method static ChannelInterface|Proxy first(string $sortedField = 'id')
 * @method static ChannelInterface|Proxy last(string $sortedField = 'id')
 * @method static ChannelInterface|Proxy random(array $attributes = [])
 * @method static ChannelInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static ChannelInterface[]|Proxy[] all()
 * @method static ChannelInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ChannelInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ChannelInterface[]|Proxy[] findBy(array $attributes)
 * @method static ChannelInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ChannelInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ChannelFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithLocalesTrait;
    use WithCurrenciesTrait;
    use ToggableTrait;

    public function withDefaultLocale(Proxy|LocaleInterface|string $defaultLocale): self
    {
        return $this->addState(['defaultLocale' => $defaultLocale]);
    }

    public function withHostname(string $hostname): self
    {
        return $this->addState(['hostname' => $hostname]);
    }

    public function withColor(string $color): self
    {
        return $this->addState(['color' => $color]);
    }

    public function withSkippingShippingStepAllowed(): self
    {
        return $this->addState(['skippingShippingStepAllowed' => true]);
    }

    public function withSkippingPaymentStepAllowed(): self
    {
        return $this->addState(['skippingPaymentStepAllowed' => true]);
    }

    public function withoutAccountVerificationRequired(): self
    {
        return $this->addState(['accountVerificationRequired' => false]);
    }

    public function withDefaultTaxZone(Proxy|ZoneInterface|string $defaultTaxZone): self
    {
        return $this->addState(['defaultTaxZone' => $defaultTaxZone]);
    }

    public function withTaxCalculationStrategy(string $taxCalculationStrategy): self
    {
        return $this->addState(['taxCalculationStrategy' => $taxCalculationStrategy]);
    }

    public function withThemeName(?string $themeName): self
    {
        return $this->addState(['themeName' => $themeName]);
    }

    public function withContactEmail(string $contactEmail): self
    {
        return $this->addState(['contactEmail' => $contactEmail]);
    }

    public function withContactPhoneNumber(string $contactPhoneNumber): self
    {
        return $this->addState(['contactPhoneNumber' => $contactPhoneNumber]);
    }

    public function withShopBillingData(Proxy|ShopBillingDataInterface|array $shopBillingData): self
    {
        return $this->addState(['shopBillingData' => $shopBillingData]);
    }

    public function withMenuTaxon(Proxy|TaxonInterface|string $menuTaxon): self
    {
        return $this->addState(['menuTaxon' => $menuTaxon]);
    }

    protected static function getClass(): string
    {
        return self::$modelClass ?? Channel::class;
    }
}
