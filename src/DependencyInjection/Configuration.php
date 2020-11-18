<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use DH\ArtisCmsPlugin\View;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('digital_holding_artis_cms_plugin');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('view_classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('frequently_asked_question')->defaultValue(View\FAQ\FAQView::class)->end()
                        ->scalarNode('frequently_asked_question_section')->defaultValue(View\FAQSection\FAQSectionView::class)->end()
                        ->scalarNode('map_point')->defaultValue(View\MapPoint\MapPointView::class)->end()
                        ->scalarNode('media')->defaultValue(View\Media\MediaView::class)->end()
                        ->scalarNode('page')->defaultValue(View\Page\PageView::class)->end()
                        ->scalarNode('section')->defaultValue(View\Section\SectionView::class)->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
