<?php

namespace Johnkhansrc\IaphubBundle\Exception;

use Exception;

class IaphubBundleBadQueryStringValueException extends Exception
{
    /**
     * @param array<int, int|string> $expected
     */
    public function __construct(string $uri, array $expected, string $rejected)
    {
        $acceptedParameters = implode(', ', $expected);
        $message = "Cant call $uri with query parameter value '$rejected', accepted values: $acceptedParameters";

        parent::__construct($message);
    }
}