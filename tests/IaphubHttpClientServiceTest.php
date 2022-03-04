<?php

namespace Johnkhansrc\IaphubBundle\Tests;

use Johnkhansrc\IaphubBundle\Service\IaphubHttpClientService;
use Johnkhansrc\IaphubBundle\Tests\Mocks\FakeHTTPCLient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IaphubHttpClientServiceTest extends TestCase
{
    private JohnkhansrcIaphubTestingKernel $kernel;
    private ContainerInterface $container;
    private IaphubHttpClientService $httpClientService;
    private HttpClientInterface $clientMock;

    public function setUp(): void
    {
        $kernel = new JohnkhansrcIaphubTestingKernel([
            'apikey' => 'foo',
            'webhook_auth_token' => 'bar',
        ]);
        $kernel->boot();
        $container = $kernel->getContainer();

        /** @var IaphubHttpClientService $httpClientService */
        $httpClientService = $container->get('johnkhansrc_iaphub.iaphub_http_client_service');

        $this->kernel = $kernel;
        $this->container = $container;
        $this->httpClientService = $httpClientService;
        $this->clientMock = $httpClientService->getClient();

        parent::setUp();
    }

    public function testClientIsMocked(): void
    {
        self::assertInstanceOf(FakeHTTPCLient::class, $this->clientMock);
    }

    public function testGetApikey(): void
    {
        self::assertEquals('foo', $this->httpClientService->getApikey());
    }
}
