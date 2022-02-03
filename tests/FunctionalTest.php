<?php

namespace Johnkhansrc\IaphubBundle\Tests;

use Johnkhansrc\IaphubBundle\Iaphub;
use Johnkhansrc\IaphubBundle\IaphubBundle;
use Johnkhansrc\IaphubBundle\Service\IaphubHttpClientService;
use Johnkhansrc\IaphubBundle\Service\IaphubWebhookRequestValidatorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        $kernel = new JohnkhansrcIaphubTestingKernel([
            'apikey' => 'foo',
            'webhook_auth_token' => 'bar',
        ]);
        $kernel->boot();
        $container = $kernel->getContainer();

        $iaphub = $container->get('johnkhansrc_iaphub.iaphub');
        self::assertInstanceOf(Iaphub::class, $iaphub);
        self::assertInstanceOf(IaphubHttpClientService::class, $iaphub->apiClient());
        self::assertEquals('foo', $iaphub->apiClient()->getApiKey());

        $iaphubWebhookRequestValidatorService = $container->get('johnkhansrc_iaphub.iaphub_webhook_request_validator_service');
        self::assertInstanceOf(IaphubWebhookRequestValidatorService::class, $iaphubWebhookRequestValidatorService);
        self::assertEquals('bar', $iaphubWebhookRequestValidatorService->getWebhookAuthToken());
    }
}

class JohnkhansrcIaphubTestingKernel extends Kernel
{
    private array $iaphubConfig;

    public function __construct(array $iaphubConfig = [])
    {
        $this->iaphubConfig = $iaphubConfig;
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new IaphubBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $containerBuilder) {
            $containerBuilder->loadFromExtension('johnkhansrc_iaphub', $this->iaphubConfig);
        });
    }
}