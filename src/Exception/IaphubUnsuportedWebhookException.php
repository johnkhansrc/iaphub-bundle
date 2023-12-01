<?php

namespace Johnkhansrc\IaphubBundle\Exception;

use Exception;

class IaphubUnsuportedWebhookException extends Exception
{
    public function __construct(string $webhookType)
    {
        $message = "Unexpected webhook type: $webhookType";

        parent::__construct($message);
    }
}