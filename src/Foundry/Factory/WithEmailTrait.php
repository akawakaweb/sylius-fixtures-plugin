<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithEmailTrait
{
    public function withEmail(string $email): self
    {
        return $this->addState(['email' => $email]);
    }
}
