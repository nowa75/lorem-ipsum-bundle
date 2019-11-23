<?php
/**
 * Created by Michał Nowacki
 * Date: 23/11/2019
 * Time: 18:30
 * Filename: Configuration.php
 */

namespace KnpU\LoremIpsumBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('knpu_lorem_ipsum');

        $rootNode
            ->children()
                ->booleanNode('unicorns_are_real')->defaultTrue()->info('Whether or not you believe in unicorns')->end()
                ->integerNode('min_sunshine')->defaultValue(3)->info('How much do you like sunshine?')->end()
                ->scalarNode('word_provider')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}