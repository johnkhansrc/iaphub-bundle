<?php

namespace Johnkhansrc\IaphubBundle\Service;

use Exception;
use Johnkhansrc\IaphubBundle\Exception\IaphubApiResponseException;
use Johnkhansrc\IaphubBundle\Exception\IaphubBundleBadQueryStringException;
use Johnkhansrc\IaphubBundle\Exception\IaphubBundleBadQueryStringValueException;
use Johnkhansrc\IaphubBundle\Factory\Api\GetPurchasesFactory;
use Johnkhansrc\IaphubBundle\Factory\Api\GetUserApiResponseFactory;
use Johnkhansrc\IaphubBundle\Factory\Api\PostUserReceiptResponseFactory;
use Johnkhansrc\IaphubBundle\Factory\Api\PurchaseFactory;
use Johnkhansrc\IaphubBundle\Factory\Api\ReceiptFactory;
use Johnkhansrc\IaphubBundle\Model\Api\GetPurchases;
use Johnkhansrc\IaphubBundle\Model\Api\GetUserApiResponse;
use Johnkhansrc\IaphubBundle\Model\Api\PostUserReceiptResponse;
use Johnkhansrc\IaphubBundle\Model\Api\Purchase;
use Johnkhansrc\IaphubBundle\Model\Api\Receipt;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IaphubHttpClientService
{
    public const GET_USER_URI = '/v1/app/:appId/user/:userId';
    public const GET_USER_MIGRATE_URI = '/v1/app/:appId/user/:userId/migrate';
    public const POST_USER_URI = '/v1/app/:appId/user/:userId';
    public const POST_USER_RECEIPT_URI = '/v1/app/:appId/user/:userId/receipt';
    public const GET_PURCHASE_URI = '/v1/app/:appId/purchase/:purchaseId';
    public const GET_PURCHASES_URI = '/v1/app/:appId/purchases';
    public const GET_SUBSCRIPTION_URI = '/v1/app/:appId/subscription/:originalPurchaseId';
    public const GET_RECEIPT_URI = '/v1/app/:appId/receipt/:receiptId';
    public const IAPHUB_API_DOMAIN = 'https://api.iaphub.com';
    private string $apikey;
    private IaphubHttpClientValidationService $iaphubHttpClientValidationService;
    private HttpClientInterface $client;
    private string $apiUri;
    private string $method;

    public function __construct(string $apikey,
                                IaphubHttpClientValidationService $iaphubHttpClientValidationService,
                                HttpClientInterface $client)
    {
        $this->apikey = $apikey;
        $this->iaphubHttpClientValidationService = $iaphubHttpClientValidationService;
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getApikey(): string
    {
        return $this->apikey;
    }

    /**
     * @param string $apikey
     */
    public function setApikey(string $apikey): void
    {
        $this->apikey = $apikey;
    }

    /**
     * @return IaphubHttpClientValidationService
     */
    public function getIaphubHttpClientValidationService(): IaphubHttpClientValidationService
    {
        return $this->iaphubHttpClientValidationService;
    }

    /**
     * @param IaphubHttpClientValidationService $iaphubHttpClientValidationService
     */
    public function setIaphubHttpClientValidationService(IaphubHttpClientValidationService $iaphubHttpClientValidationService): void
    {
        $this->iaphubHttpClientValidationService = $iaphubHttpClientValidationService;
    }

    /**
     * @return HttpClientInterface
     */
    public function getClient(): HttpClientInterface
    {
        return $this->client;
    }

    /**
     * @param HttpClientInterface $client
     */
    public function setClient(HttpClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * @param mixed[] $body
     * @throws TransportExceptionInterface
     */
    public function post(array $body)
    {
        $this->method = 'POST';

        return $this->client->request(
            $this->method,
            self::IAPHUB_API_DOMAIN.$this->apiUri,
            [
                'headers' => $this->header(),
                'json' => $body
            ]
        );
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function fetch()
    {
        $this->method = 'GET';

        return $this->client->request(
            $this->method,
            self::IAPHUB_API_DOMAIN.$this->apiUri,
            [
                'headers' => $this->header()
            ]
        );
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function fetchWithQueryParameters(array $queryParameters)
    {
        $this->method = 'GET';

        return $this->client->request(
            $this->method,
            self::IAPHUB_API_DOMAIN.$this->apiUri,
            [
                'headers' => $this->header(),
                'query' => $queryParameters
            ]
        );
    }

    public function header(): array
    {
        return [
            'Accept' => 'application/json',
            'Authorization' => "ApiKey {$this->getApikey()}"
        ];
    }

    public function setUri($urlParametersNames, $urlParametersValues, $uri): void
    {
        $this->apiUri = str_replace($urlParametersNames, $urlParametersValues, $uri);
    }

    /**
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws Exception
     */
    public function getUser(string $userId, string $appId, ?array $queryParameters = null): GetUserApiResponse
    {
        $this->apiUri = str_replace([':userId', ':appId'], [$userId, $appId], self::GET_USER_URI);

        if (null !== $queryParameters) {
            $this->iaphubHttpClientValidationService->validateParameters($queryParameters, __METHOD__, $this->apiUri);
            $response = $this->fetchWithQueryParameters($queryParameters);
        } else {
            $response = $this->fetch();
        }

        if (200 !== $response->getStatusCode()) {
            throw new IaphubApiResponseException($this->method, $this->apiUri, $response->getStatusCode());
        }

        return GetUserApiResponseFactory::build($response->toArray());
    }

    /**
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface|IaphubBundleBadQueryStringException
     */
    public function getUserMigrate(string $userId, string $appId, ?array $queryParameters = null): string
    {
        $this->apiUri = str_replace([':userId', ':appId'], [$userId, $appId], self::GET_USER_MIGRATE_URI);

        if (null !== $queryParameters) {
            $this->validateParameters($queryParameters, __METHOD__);
            $response = $this->fetchWithQueryParameters($queryParameters);
        } else {
            $response = $this->fetch();
        }

        if (200 !== $response->getStatusCode()) {
            throw new IaphubApiResponseException($this->method, $this->apiUri, $response->getStatusCode());
        }

        $responsePayload = $response->toArray();

        return $responsePayload['userId'];
    }

    /**
     * @throws TransportExceptionInterface
     * @throws IaphubBundleBadQueryStringException
     */
    public function postUser(string $userId, array $payloadData, string $appId): void
    {
        $this->apiUri = str_replace([':userId', ':appId'], [$userId, $appId], self::POST_USER_URI);

        $this->validateBodyParameters($payloadData, __METHOD__);
        $this->post($payloadData);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws IaphubBundleBadQueryStringException
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function postUserReceipt(string $userId, array $payloadData, string $appId): PostUserReceiptResponse
    {
        $this->apiUri = str_replace([':userId', ':appId'], [$userId, $appId], self::POST_USER_RECEIPT_URI);

        $this->validateBodyParameters($payloadData, __METHOD__);
        $response = $this->post($payloadData);

        return PostUserReceiptResponseFactory::build($response->toArray());
    }

    /**
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws IaphubBundleBadQueryStringException
     */
    public function getPurchase(string $purchaseId, string $appId, ?array $queryParameters = null): Purchase
    {
        $this->apiUri = str_replace([':purchaseId', ':appId'], [$purchaseId, $appId], self::GET_PURCHASE_URI);

        if (null !== $queryParameters) {
            $this->validateParameters($queryParameters, __METHOD__);
            $response = $this->fetchWithQueryParameters($queryParameters);
        } else {
            $response = $this->fetch();
        }

        if (200 !== $response->getStatusCode()) {
            throw new IaphubApiResponseException($this->method, $this->apiUri, $response->getStatusCode());
        }

        return PurchaseFactory::buildPurchase($response->toArray());
    }

    /**
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface|IaphubBundleBadQueryStringException
     */
    public function getPurchases(string $appId, ?array $queryParameters = null): GetPurchases
    {
        $this->apiUri = str_replace(':appId', $appId, self::GET_PURCHASES_URI);

        if (null !== $queryParameters) {
            $this->validateParameters($queryParameters, __METHOD__);
            $response = $this->fetchWithQueryParameters($queryParameters);
        } else {
            $response = $this->fetch();
        }

        if (200 !== $response->getStatusCode()) {
            throw new IaphubApiResponseException($this->method, $this->apiUri, $response->getStatusCode());
        }

        return GetPurchasesFactory::build($response->toArray());
    }

    /**
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface|IaphubBundleBadQueryStringException
     * @throws Exception
     */
    public function getSubscription(string $originalPurchaseId, string $appId, ?array $queryParameters = null): Purchase
    {
        $this->apiUri = str_replace(
            [':originalPurchaseId', ':appId'], [$originalPurchaseId, $appId], self::GET_SUBSCRIPTION_URI);

        if (null !== $queryParameters) {
            $this->validateParameters($queryParameters, __METHOD__);
            $response = $this->fetchWithQueryParameters($queryParameters);
        } else {
            $response = $this->fetch();
        }

        if (200 !== $response->getStatusCode()) {
            throw new IaphubApiResponseException($this->method, $this->apiUri, $response->getStatusCode());
        }

        return PurchaseFactory::buildPurchase($response->toArray());
    }

    /**
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws Exception
     */
    public function getReceipt(string $receiptId, string $appId, ?array $queryParameters = null): Receipt
    {
        $this->apiUri = str_replace([':receiptId', ':appId'], [$receiptId, $appId], self::GET_RECEIPT_URI);

        if (null !== $queryParameters) {
            $this->validateParameters($queryParameters, __METHOD__);
            $response = $this->fetchWithQueryParameters($queryParameters);
        } else {
            $response = $this->fetch();
        }

        if (200 !== $response->getStatusCode()) {
            throw new IaphubApiResponseException($this->method, $this->apiUri, $response->getStatusCode());
        }

        return ReceiptFactory::build($response->toArray());
    }

    /**
     * @throws IaphubBundleBadQueryStringException
     * @throws IaphubBundleBadQueryStringValueException
     */
    private function validateParameters(array $queryParameters, string $method)
    {
        $this->getIaphubHttpClientValidationService()->validateParameters($queryParameters, $method, $this->apiUri);
    }

    /**
     * @throws IaphubBundleBadQueryStringValueException
     * @throws IaphubBundleBadQueryStringException
     */
    private function validateBodyParameters(array $bodyParameters, string $method): void
    {
        $this->getIaphubHttpClientValidationService()->validateBodyParameters($bodyParameters, $method, $this->apiUri);
    }
}