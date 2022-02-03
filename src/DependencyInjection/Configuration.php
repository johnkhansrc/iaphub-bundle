<?php

namespace Johnkhansrc\IaphubBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('johnkhansrc_iaphub');
        $rootNode
            ->children()
                ->scalarNode('apikey')
                    ->info('Iaphub server API key. Define it in dashboard.iaphub.com/app/{app_id}/settings (API KEYS section).')
                    ->isRequired()
                    ->end()
                ->scalarNode('webhook_auth_token')
                    ->info('Iaphub webhook auth token. Define it in dashboard.iaphub.com/app/{app_id}/settings (WEBHOOKS section).')
                    ->isRequired()
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}