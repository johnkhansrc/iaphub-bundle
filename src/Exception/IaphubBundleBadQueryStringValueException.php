<?php

namespace Johnkhansrc\IaphubBundle\Exception;

use Exception;

class IaphubBundleBadQueryStringValueException extends Exception
{
    public function __construct($uri, $expected, $rejected)
    {
        $acceptedParameters = implode(', ', $expected);
        $message = "Cant call $uri with query parameter value '$rejected', accepted values: $acceptedParameters";

        parent::__construct($message);
    }
}