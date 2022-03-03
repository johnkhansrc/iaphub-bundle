<?php

namespace Johnkhansrc\IaphubBundle\Service;

use Johnkhansrc\IaphubBundle\Exception\IaphubBundleBadQueryStringException;
use Johnkhansrc\IaphubBundle\Exception\IaphubBundleBadQueryStringValueException;

class IaphubHttpClientValidationService
{
    public const VALID_QUERY_PARAMETERS = [
        'getUser' => [
            'environment' => ['production', 'staging', 'development'],
            'platform' => ['ios', 'android'],
            'upsert' => []
        ],
        'getUserMigrate' => ['environment' => ['production', 'staging', 'development']],
        'getPurchase' => ['environment' => ['production', 'staging', 'development']],
        'getPurchases' => [
            'environment' => ['production', 'staging', 'development'],
            'page' => [],
            'limit' => [],
            'order' => ['desc', 'asc'],
            'fromDate' => [],
            'toDate' => [],
            'user' => [],
            'userId' => [],
            'originalPurchase' => [],
        ],
        'getSubscription' => ['environment' => ['production', 'staging', 'development']],
        'getReceipt' => ['environment' => ['production', 'staging', 'development']],
    ];
    public const VALID_BODY_PARAMETERS = [
        'postUser' => [
            'environment' => ['production', 'staging', 'development'],
            'tags' => [],
            'country' => [],
            'userId' => [],
            'upsert' => []
        ],
        'postUserReceipt' => [
            'environment' => ['production', 'staging', 'development'],
            'platform' => ['ios', 'android'],
            'token' => [],
            'sku' => [],
            'context' => ['refresh', 'purchase', 'restore'],
            'prorationMode' => [
                'immediate_with_time_proration',
                'immediate_and_charge_prorated_price',
                'immediate_without_proration'
            ],
            'upsert' => []
        ],
    ];

    private static function withoutNamespace(string $method)
    {
        return preg_replace('/[a-zA-Z\\\]+[\:]{2}/', '', $method);
    }

    /**
     * @throws IaphubBundleBadQueryStringException
     * @throws IaphubBundleBadQueryStringValueException
     */
    public function validateParameters(array $queryParameters, string $method, string $apiUri): void
    {
        foreach (array_keys($queryParameters) as $parameter) {
            if (!array_key_exists($parameter, self::VALID_QUERY_PARAMETERS[self::withoutNamespace($method)])) {
                throw new IaphubBundleBadQueryStringException(
                    $apiUri, array_keys(self::VALID_QUERY_PARAMETERS[self::withoutNamespace($method)]), self::withoutNamespace($method));
            }
            if (self::VALID_QUERY_PARAMETERS[self::withoutNamespace($method)][$parameter]) {
                $this->validateParameterValues(self::VALID_QUERY_PARAMETERS[self::withoutNamespace($method)][$parameter], $queryParameters[$parameter], $apiUri);
            }
        }
    }

    /**
     * @throws IaphubBundleBadQueryStringValueException
     */
    private function validateParameterValues($acceptedParameterValues, $parameterValue, string $apiUri): void
    {
        if (!in_array($parameterValue, $acceptedParameterValues, true)) {
            throw new IaphubBundleBadQueryStringValueException($apiUri, $acceptedParameterValues, $parameterValue);
        }
    }

    /**
     * @throws IaphubBundleBadQueryStringException
     * @throws IaphubBundleBadQueryStringValueException
     */
    public function validateBodyParameters(array $bodyParameters, string $method, string $apiUri): void
    {
        foreach (array_keys($bodyParameters) as $parameter) {
            if (!array_key_exists($parameter, self::VALID_BODY_PARAMETERS[self::withoutNamespace($method)])) {
                throw new IaphubBundleBadQueryStringException(
                    $apiUri, array_keys(self::VALID_BODY_PARAMETERS[self::withoutNamespace($method)]), self::withoutNamespace($method));
            }
            if (self::VALID_QUERY_PARAMETERS[self::withoutNamespace($method)][$parameter]) {
                $this->validateBodyParameterValues(self::VALID_BODY_PARAMETERS[self::withoutNamespace($method)][$parameter], $bodyParameters[$parameter], $apiUri);
            }
        }
    }

    /**
     * @throws IaphubBundleBadQueryStringValueException
     */
    private function validateBodyParameterValues($acceptedParameterValues, $parameterValue, string $apiUri): void
    {
        if (!in_array($parameterValue, $acceptedParameterValues, true)) {
            throw new IaphubBundleBadQueryStringValueException($apiUri, $acceptedParameterValues, $parameterValue);
        }
    }
}