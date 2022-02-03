<?php

namespace Johnkhansrc\IaphubBundle\Exception;

use Exception;

class IaphubBundleBadQueryStringException extends Exception
{
    public function __construct($uri, $expected, $rejected)
    {
        $acceptedParameters = implode(', ', $expected);
        $message = "Cant call $uri with query parameter '$rejected', accepted parameters: $acceptedParameters";

        parent::__construct($message);
    }
}