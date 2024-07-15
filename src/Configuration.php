<?php

namespace GrinWay\WebApp;

use function Symfony\Component\String\u;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use GrinWay\WebApp\GrinWayWebAppExtension;

class Configuration implements ConfigurationInterface
{
    public function __construct()
    {
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(GrinWayWebAppExtension::PREFIX);

        $treeBuilder->getRootNode()
            ->info(''
                . 'You can copy this example: "'
                . \dirname(__DIR__)
                . DIRECTORY_SEPARATOR . 'config'
                . DIRECTORY_SEPARATOR . 'packages'
                . DIRECTORY_SEPARATOR . 'grin_way_web_app.yaml'
                . '"')
            ->children()

                ->arrayNode(GrinWayWebAppExtension::DOCTRINE_NODE_NAME)
                    ->info('Doctrine event listeners')
                    ->addDefaultsIfNotSet()
                    ->children()

                        ->arrayNode(GrinWayWebAppExtension::PRE_PERSIST_FOR_CREATED_AT_EVENT_LISTENER_NODE_NAME)
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode(GrinWayWebAppExtension::IS_LISTEN_NODE_NAME)
                                    ->info('Do listen to pre persist for setting created at?')
                                    ->defaultTrue()
                                ->end()
                                ->integerNode(GrinWayWebAppExtension::PRIORITY_NODE_NAME)
                                    ->info('Priority')
                                    ->defaultValue(0)
                                ->end()
                                ->scalarNode(GrinWayWebAppExtension::CONNECTION_NODE_NAME)
                                    ->info('EntityManager::getConnection()')
                                    ->defaultValue('default')
                                ->end()
                            ->end()
                        ->end()

                        ->arrayNode(GrinWayWebAppExtension::PRE_PERSIST_FOR_UPDATED_AT_EVENT_LISTENER_NODE_NAME)
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode(GrinWayWebAppExtension::IS_LISTEN_NODE_NAME)
                                    ->info('Do listen to pre update for setting updated at?')
                                    ->defaultTrue()
                                ->end()
                                ->integerNode(GrinWayWebAppExtension::PRIORITY_NODE_NAME)
                                    ->info('Priority')
                                    ->defaultValue(0)
                                ->end()
                                ->scalarNode(GrinWayWebAppExtension::CONNECTION_NODE_NAME)
                                    ->info('EntityManager::getConnection()')
                                    ->defaultValue('default')
                                ->end()
                            ->end()
                        ->end()

                    ->end()
                ->end()

            ->end()
        ;

        return $treeBuilder;
    }

    //###> HELPERS ###
}
