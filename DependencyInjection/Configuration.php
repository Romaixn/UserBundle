<?php

namespace Rherault\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration extends ConfigurationInterface {

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rherault_user');
        $rootNode
            ->children()
            ->scalarNode('user_class')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->scalarNode('email_from')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
        ->end();

        return $treeBuilder;
    }
}