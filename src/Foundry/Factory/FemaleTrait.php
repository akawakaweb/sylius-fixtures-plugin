<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Sylius\Component\Customer\Model\CustomerInterface;
use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait FemaleTrait
{
    public function female(): self
    {
        return $this->addState(['gender' => CustomerInterface::FEMALE_GENDER]);
    }
}
