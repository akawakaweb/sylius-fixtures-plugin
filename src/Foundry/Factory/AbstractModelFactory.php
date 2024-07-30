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

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Factory;

use Akawakaweb\SyliusFixturesPlugin\Foundry\DefaultValues\DefaultValuesInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Initiator\InitiatorInterface;
use Akawakaweb\SyliusFixturesPlugin\Foundry\Transformer\TransformerInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @template TModel of object
 *
 * @template-extends PersistentProxyObjectFactory<TModel>
 */
abstract class AbstractModelFactory extends PersistentProxyObjectFactory
{
    public function __construct(
        private DefaultValuesInterface $defaultValues,
        private TransformerInterface $transformer,
        private InitiatorInterface $initiator,
    ) {
        parent::__construct();
    }

    protected function defaults(): array
    {
        return ($this->defaultValues)(self::faker());
    }

    protected function initialize(): PersistentProxyObjectFactory
    {
        return $this
            ->beforeInstantiate([$this->transformer, 'transform'])
            ->instantiateWith([$this->initiator, '__invoke'])
        ;
    }
}
