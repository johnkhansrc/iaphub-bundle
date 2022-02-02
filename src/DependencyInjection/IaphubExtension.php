<?php

namespace Johnkhansrc\IaphubBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class IaphubExtension extends Extension
{

    /**
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Ressources/config'));
        $loader->load('services.xml');

        /** @var Configuration $configuration */
        $configuration = $this->getConfiguration($configs, $container);
        $configs = $this->processConfiguration($configuration, $configs);

        // Inject apikey inside IaphubHttpClientService.
        $iaphubHttpClientServiceDefinition = $container->getDefinition('johnkhansrc_iaphub.iaphub_http_client_service');
        $iaphubHttpClientServiceDefinition->setArgument(0, $configs['apikey']);

        // Inject unicorns_are_real and min_sunshine.
        $definition = $container->getDefinition('johnkhansrc_iaphub.iaphub');
        $definition->setArgument(1, $configs['unicorns_are_real']);
        $definition->setArgument(2, $configs['min_sunshine']);
//        var_dump($definition);die;
    }

    /**
     * Override config alias name.
     */
    public function getAlias(): string
    {
        return 'johnkhansrc_iaphub';
    }


}