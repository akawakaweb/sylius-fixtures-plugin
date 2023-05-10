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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Transformer;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CatalogPromotionActionFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\CatalogPromotionScopeFactory;
use Sylius\Component\Core\Model\CatalogPromotionScopeInterface;
use Sylius\Component\Promotion\Model\CatalogPromotionActionInterface;
use Zenstruck\Foundry\Proxy;

final class CatalogPromotionTransformer implements TransformerInterface
{
    use TransformNameToCodeAttributeTrait;
    use TransformStringToDateAttributeTrait;
    use TransformChannelsAttributeTrait;

    public function transform(array $attributes): array
    {
        $attributes = $this->transformNameToCodeAttribute($attributes);
        $attributes = $this->transformStringToDateAttribute($attributes, 'startDate');
        $attributes = $this->transformStringToDateAttribute($attributes, 'endDate');
        $attributes = $this->transformChannelsAttribute($attributes);
        $attributes = $this->transformScopesAttribute($attributes);

        return $this->transformActionsAttribute($attributes);
    }

    private function transformActionsAttribute(array $attributes): array
    {
        $actions = &$attributes['actions'];

        if (!is_array($actions)) {
            return $attributes;
        }

        /**
         * @var int $key
         * @var Proxy<CatalogPromotionActionInterface>|CatalogPromotionActionInterface|array $action
         */
        foreach ($actions as $key => $action) {
            if (\is_array($action)) {
                $actions[$key] = CatalogPromotionActionFactory::createOne($action);
            }
        }

        return $attributes;
    }

    private function transformScopesAttribute(array $attributes): array
    {
        $scopes = &$attributes['scopes'];

        if (!is_array($scopes)) {
            return $attributes;
        }

        /**
         * @var int $key
         * @var Proxy<CatalogPromotionScopeInterface>|CatalogPromotionScopeInterface|array $scope
         */
        foreach ($scopes as $key => $scope) {
            if (\is_array($scope)) {
                $scopes[$key] = CatalogPromotionScopeFactory::createOne($scope);
            }
        }

        return $attributes;
    }
}
