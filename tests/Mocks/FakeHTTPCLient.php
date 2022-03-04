<?php

namespace Johnkhansrc\IaphubBundle\Tests\Mocks;

use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

/**
 * @method  withOptions(array $options)
 */
class FakeHTTPCLient implements HttpClientInterface
{
    private array $responses;

    public function __construct(array $responses = [])
    {
        $this->responses = $responses;
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $response = new MockResponse(
            '{"data": 1}',
            [
                'response_headers' => ['content-type' => 'application/json'],
                'http_code' => 200
            ]
        );
        $this->responses[] = $response;

        return $response;
    }

    public function stream($responses, float $timeout = null): ResponseStreamInterface
    {
        throw new \LogicException(sprintf('%s() is not implemented', __METHOD__));
    }

    public function __call($name, $arguments)
    {
        return $this;
    }
}