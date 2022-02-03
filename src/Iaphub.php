<?php

namespace Johnkhansrc\IaphubBundle;

use Johnkhansrc\IaphubBundle\Service\IaphubHttpClientService;

/**
 * An Iaphub integration for symfony application for receive webhooks and manage Iaphub API.
 */
class Iaphub
{
    private IaphubHttpClientService $iaphubHttpClient;

    public function __construct(IaphubHttpClientService $iaphubHttpClient)
    {
        $this->iaphubHttpClient = $iaphubHttpClient;
    }

    public function apiClient(): IaphubHttpClientService
    {
        return $this->iaphubHttpClient;
    }
}
