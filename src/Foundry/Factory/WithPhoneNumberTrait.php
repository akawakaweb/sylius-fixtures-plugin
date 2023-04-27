<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithPhoneNumberTrait
{
    public function withPhoneNumber(string $phoneNumber): self
    {
        return $this->addState(['phoneNumber' => $phoneNumber]);
    }
}
