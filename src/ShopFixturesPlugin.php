<?php

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class ShopFixturesPlugin extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $loader = new PhpFileLoader($builder, new FileLocator(__DIR__ . '/../config'));
        $loader->load('services.php');
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
