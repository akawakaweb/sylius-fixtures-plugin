<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithFirstNameTrait
{
    public function withFirstName(string $firstName): self
    {
        return $this->addState(['firstName' => $firstName]);
    }
}
