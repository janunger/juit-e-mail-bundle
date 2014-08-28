<?php

namespace Juit\EMailBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('xxx');

        $rootNode
            ->children()
                ->scalarNode('default_e_mail_sender_address')
                    ->defaultNull()
                ->end()
                ->scalarNode('default_e_mail_sender_name')
                    ->defaultNull()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
