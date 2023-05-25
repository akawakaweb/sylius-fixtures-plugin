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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\State;

use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @mixin ModelFactory
 */
trait WithTaxCategoryTrait
{
    public function withTaxCategory(Proxy|TaxCategoryInterface|string $taxCategory): self
    {
        return $this->addState(['taxCategory' => $taxCategory]);
    }
}
