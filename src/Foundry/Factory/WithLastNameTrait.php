<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithLastNameTrait
{
    public function withLastName(string $lastName): self
    {
        return $this->addState(['lastName' => $lastName]);
    }
}
