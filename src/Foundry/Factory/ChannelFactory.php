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

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\ToggableTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithCurrenciesTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithLocalesTrait;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Doctrine\ORM\EntityRepository;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\Channel;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShopBillingDataInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use function Zenstruck\Foundry\lazy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ChannelInterface>
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
final class ChannelFactory extends ModelFactory
{
    use WithCodeTrait;
    use WithNameTrait;
    use WithLocalesTrait;
    use WithCurrenciesTrait;
    use ToggableTrait;

    public function __construct()
    {
        parent::__construct();
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
        return $this->addState(['skipping_shipping_step_allowed' => true]);
    }

    public function withSkippingPaymentStepAllowed(): self
    {
        return $this->addState(['skipping_payment_step_allowed' => true]);
    }

    public function withoutAccountVerificationRequired(): self
    {
        return $this->addState(['account_verification_required' => false]);
    }

    public function withDefaultTaxZone(Proxy|ZoneInterface|string $defaultTaxZone): self
    {
        return $this->addState(['default_tax_zone' => $defaultTaxZone]);
    }

    public function withTaxCalculationStrategy(string $taxCalculationStrategy): self
    {
        return $this->addState(['tax_calculation_strategy' => $taxCalculationStrategy]);
    }

    public function withThemeName(?string $themeName): self
    {
        return $this->addState(['theme_name' => $themeName]);
    }

    public function withContactEmail(string $contactEmail): self
    {
        return $this->addState(['contact_email' => $contactEmail]);
    }

    public function withContactPhoneNumber(string $contactPhoneNumber): self
    {
        return $this->addState(['contact_phone_number' => $contactPhoneNumber]);
    }

    public function withShopBillingData(Proxy|ShopBillingDataInterface|array $shopBillingData): self
    {
        return $this->addState(['shop_billing_data' => $shopBillingData]);
    }

    public function withMenuTaxon(Proxy|TaxonInterface|string $menuTaxon): self
    {
        return $this->addState(['menu_taxon' => $menuTaxon]);
    }

    protected function getDefaults(): array
    {
        return [
            'accountVerificationRequired' => self::faker()->boolean(),
            'baseCurrency' => lazy(function (): Proxy {
                /** @var Proxy<CurrencyInterface> $currency */
                $currency = CurrencyFactory::randomOrCreate();

                return $currency;
            }),
            'code' => self::faker()->text(),
            'createdAt' => self::faker()->dateTime(),
            'defaultLocale' => lazy(function (): Proxy {
                /** @var Proxy<LocaleInterface> $locale */
                $locale = LocaleFactory::randomOrCreate();

                return $locale;
            }),
            'enabled' => self::faker()->boolean(),
            'locales' => lazy(function (): array {
                return LocaleFactory::all();
            }),
            'name' => self::faker()->text(),
            'shippingAddressInCheckoutRequired' => self::faker()->boolean(),
            'skippingPaymentStepAllowed' => self::faker()->boolean(),
            'skippingShippingStepAllowed' => self::faker()->boolean(),
            'taxCalculationStrategy' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Channel $channel): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Channel::class;
    }
}
