<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @mixin ModelFactory
 */
trait WithBirthdayTrait
{
    public function withBirthday(\DateTimeInterface|string $birthday): self
    {
        return $this->addState(['birthday' => $birthday]);
    }
}
