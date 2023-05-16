<?php

/*
 * This file is part of ShopFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

use Akawakaweb\ShopFixturesPlugin\Foundry\DefaultValues\DefaultValuesInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Initiator\InitiatorInterface;
use Akawakaweb\ShopFixturesPlugin\Foundry\Transformer\TransformerInterface;
use Zenstruck\Foundry\ModelFactory;

/**
 * @template TModel of object
 *
 * @template-extends ModelFactory<TModel>
 */
abstract class AbstractModelFactory extends ModelFactory
{
    public function __construct(
        private DefaultValuesInterface $defaultValues,
        private TransformerInterface $transformer,
        private InitiatorInterface $initiator,
    ) {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return ($this->defaultValues)(self::faker());
    }

    protected function initialize(): ModelFactory
    {
        return $this
            ->beforeInstantiate([$this->transformer, 'transform'])
            ->instantiateWith([$this->initiator, '__invoke'])
        ;
    }
}
