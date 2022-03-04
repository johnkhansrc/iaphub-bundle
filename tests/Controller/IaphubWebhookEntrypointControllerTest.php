<?php

namespace Johnkhansrc\IaphubBundle\Tests\Controller;

use Johnkhansrc\IaphubBundle\IaphubBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class IaphubWebhookEntrypointControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $kernel = new JohnkhansrcIaphubControllerTestingKernel([
            'apikey' => 'foo',
            'webhook_auth_token' => 'bar',
        ]);

        $payload = file_get_contents(__DIR__ . '/../Mocks/webhooksPayloads/purchaseBodyMocks.json');
        $client = new KernelBrowser($kernel);
        $method = 'POST';
        $uri = '/webhook_entry_point/';
        $client->request($method,
            $uri,
            [],    // parameters
            [],    // files
            array('HTTP_X_Auth_Token' => 'bar'), // server
            $payload);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}

class JohnkhansrcIaphubControllerTestingKernel extends Kernel
{
    use MicroKernelTrait;
    private array $iaphubConfig;

    public function __construct(array $iaphubConfig = [])
    {
        $this->iaphubConfig = $iaphubConfig;
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new IaphubBundle(),
            new FrameworkBundle()
        ];
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->import(__DIR__.'/../../src/Ressources/config/routes.xml', '/webhook_entry_point');
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension('johnkhansrc_iaphub', $this->iaphubConfig);
        $c->loadFromExtension('framework', ['secret' => 'XXXXXXX']);

    }



//    public function registerContainerConfiguration(LoaderInterface $loader)
//    {
//        $loader->load(function (ContainerBuilder $containerBuilder) {
//            $containerBuilder->loadFromExtension('johnkhansrc_iaphub', $this->iaphubConfig);
//        });
//    }
}