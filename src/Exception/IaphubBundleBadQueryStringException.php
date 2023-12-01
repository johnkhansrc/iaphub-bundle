<?php

namespace Johnkhansrc\IaphubBundle\Exception;

use Exception;

class IaphubBundleBadQueryStringException extends Exception
{
    /**
     * @param array<int, int|string> $expected
     */
    public function __construct(?string $uri, array $expected, ?string $rejected)
    {
        if (!$uri || !$rejected) {
            $uri = 'unknown uri';
            $rejected = 'unknown rejected parameter';
        }
        $acceptedParameters = implode(', ', $expected);
        $message = "Cant call $uri with query parameter '$rejected', accepted parameters: $acceptedParameters";

        parent::__construct($message);
    }
}