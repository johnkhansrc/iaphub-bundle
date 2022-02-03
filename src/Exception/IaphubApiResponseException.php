<?php

namespace Johnkhansrc\IaphubBundle\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class IaphubApiResponseException extends Exception
{
    public function __construct(string $method, string $uri, int $statusCode)
    {
        $statusText = Response::$statusTexts[$statusCode];
        $message = "$statusCode ($statusText) returned by Iaphub API for $method $uri";

        parent::__construct($message);
    }
}