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
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithChannelsTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithCodeTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithDescriptionTrait;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State\WithNameTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\PaymentMethodRepository;
use Sylius\Component\Core\Model\PaymentMethod;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends AbstractModelFactory<PaymentMethodInterface>
 *
 * @method        PaymentMethodInterface|Proxy create(array|callable $attributes = [], bool $noProxy = false)
 * @method static PaymentMethodInterface|Proxy createOne(array $attributes = [])
 * @method static PaymentMethodInterface|Proxy find(object|array|mixed $criteria)
 * @method static PaymentMethodInterface|Proxy findOrCreate(array $attributes)
 * @method static PaymentMethodInterface|Proxy first(string $sortedField = 'id')
 * @method static PaymentMethodInterface|Proxy last(string $sortedField = 'id')
 * @method static PaymentMethodInterface|Proxy random(array $attributes = [])
 * @method static PaymentMethodInterface|Proxy randomOrCreate(array $attributes = [])
 * @method static PaymentMethodRepository|ProxyRepositoryDecorator repository()
 * @method static PaymentMethodInterface[]|Proxy[] all()
 * @method static PaymentMethodInterface[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PaymentMethodInterface[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static PaymentMethodInterface[]|Proxy[] findBy(array $attributes)
 * @method static PaymentMethodInterface[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PaymentMethodInterface[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PaymentMethodFactory extends AbstractModelFactory implements FactoryWithModelClassAwareInterface
{
    use WithModelClassTrait;
    use WithCodeTrait;
    use WithNameTrait;
    use WithDescriptionTrait;
    use ToggableTrait;
    use WithChannelsTrait;

    public function withInstructions(string $instructions): self
    {
        return $this->with(['instructions' => $instructions]);
    }

    public function withGatewayName(string $gatewayName): self
    {
        return $this->with(['gatewayName' => $gatewayName]);
    }

    public function withGatewayFactory(string $gatewayFactory): self
    {
        return $this->with(['gatewayFactory' => $gatewayFactory]);
    }

    public function withGatewayConfig(array $gatewayConfig): self
    {
        return $this->with(['gatewayConfig' => $gatewayConfig]);
    }

    public static function class(): string
    {
        return self::$modelClass ?? PaymentMethod::class;
    }
}
