<?php

namespace Johnkhansrc\IaphubBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class IaphubWebhookRequestValidatorService
{
    private string $webhookAuthToken;

    public function __construct(string $webhookAuthToken)
    {
        $this->webhookAuthToken = $webhookAuthToken;
    }

    public function isValidHeader(Request $request): bool
    {
        return $this->webhookAuthToken === $request->headers->get('X-Auth-Token');
    }

    public function getWebhookAuthToken(): string
    {
        return $this->webhookAuthToken;
    }
}
