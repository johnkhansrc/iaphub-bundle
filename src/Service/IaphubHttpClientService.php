<?php

namespace Johnkhansrc\IaphubBundle\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class IaphubHttpClientService
{
    private string $apikey;
    private IaphubHttpClientValidationService $iaphubHttpClientValidationService;
    private HttpClientInterface $client;

    public function __construct(string $apikey, IaphubHttpClientValidationService $iaphubHttpClientValidationService, HttpClientInterface $client)
    {
        $this->apikey = $apikey;
        $this->iaphubHttpClientValidationService = $iaphubHttpClientValidationService;
        $this->client = $client;
    }
}