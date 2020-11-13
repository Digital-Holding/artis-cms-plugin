<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('digital_holding_artis_cms_plugin');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
