<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithCodeTrait
{
    public function withCode(string $code): self
    {
        return $this->addState(['code' => $code]);
    }
}
