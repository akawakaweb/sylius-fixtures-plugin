<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithPasswordTrait
{
    public function withPassword(string $password): self
    {
        return $this->addState(['password' => $password]);
    }
}
