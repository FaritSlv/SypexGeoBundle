<?php

declare(strict_types=1);

namespace FaritSlv\Bundle\SypexGeoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Yamilovs\SypexGeo\Database\Mode;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('faritslv_sypex_geo');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('faritslv_sypex_geo');
        }

        $rootNode
            ->children()
                ->scalarNode('mode')
                    ->defaultValue(array_search(Mode::FILE, Mode::getModes(), true))
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('database_path')
                    ->defaultFalse()
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('connection')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('proxy')
                            ->children()
                                ->scalarNode('host')->defaultNull()->end()
                                ->integerNode('port')->defaultNull()->end()
                                ->arrayNode('auth')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('user')->defaultNull()->end()
                                        ->scalarNode('password')->defaultNull()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
