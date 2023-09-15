<?php

namespace Johnkhansrc\IaphubBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('johnkhansrc_iaphub');
        $rootNode = $treeBuilder->getRootNode();
        /* @phpstan-ignore-next-line */
        $rootNode
            ->children()
                ->scalarNode('apikey')
                    ->info('Iaphub server API key. Define it in dashboard.iaphub.com/app/{app_id}/settings (API KEYS section).')
                    ->defaultValue('')
                    ->end()
                ->scalarNode('webhook_auth_token')
                    ->info('Iaphub webhook auth token. Define it in dashboard.iaphub.com/app/{app_id}/settings (WEBHOOKS section).')
                    ->defaultValue('')
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}