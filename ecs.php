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

use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests/Behat',
        __DIR__ . '/ecs.php',
    ]);

    $ecsConfig->import('vendor/sylius-labs/coding-standard/ecs.php');

    $ecsConfig->skip([
        VisibilityRequiredFixer::class => ['*Spec.php'],
    ]);

    $header = <<<EOM
        This file is part of ShopFixturesPlugin.

        (c) Akawaka

        For the full copyright and license information, please view the LICENSE
        file that was distributed with this source code.
        EOM;

    $services = $ecsConfig->services();
    $services
        ->set(HeaderCommentFixer::class)
        ->call('configure', [[
            'header' => $header,
            'location' => 'after_open',
        ]])
    ;
};
