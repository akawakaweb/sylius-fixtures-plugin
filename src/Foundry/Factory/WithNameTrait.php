<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithNameTrait
{
    public function withName(string $name): self
    {
        return $this->addState(['name' => $name]);
    }
}
