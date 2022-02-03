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

        // Inject webhook_auth_token inside IaphubWebhookRequestValidatorService.
        $iaphubWebhookRequestValidatorService = $container->getDefinition('johnkhansrc_iaphub.iaphub_webhook_request_validator_service');
        $iaphubWebhookRequestValidatorService->setArgument(0, $configs['webhook_auth_token']);
    }

    /**
     * Override config alias name.
     */
    public function getAlias(): string
    {
        return 'johnkhansrc_iaphub';
    }


}