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
use Symfony\Contracts\HttpClient\ResponseInterface;

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
    public function post(array $body): ResponseInterface
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
    public function fetch(): ResponseInterface
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
     * @param mixed[] $queryParameters
     * @throws TransportExceptionInterface
     */
    public function fetchWithQueryParameters(array $queryParameters): ResponseInterface
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

    /**
     * @return array<string, string>
     */
    public function header(): array
    {
        return [
            'Accept' => 'application/json',
            'Authorization' => "ApiKey {$this->getApikey()}"
        ];
    }

    public function setUri(string $urlParametersNames, string $urlParametersValues, string $uri): void
    {
        $this->apiUri = str_replace($urlParametersNames, $urlParametersValues, $uri);
    }

    /**
     * @param mixed[]|null $queryParameters
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

        $this->validResponse($response);

        return GetUserApiResponseFactory::build($response->toArray());
    }

    /**
     * @param mixed[]|null $queryParameters
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface|IaphubBundleBadQueryStringException|IaphubBundleBadQueryStringValueException
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

        $this->validResponse($response);

        $responsePayload = $response->toArray();

        return $responsePayload['userId'];
    }

    /**
     * @param mixed[] $payloadData
     * @throws TransportExceptionInterface
     * @throws IaphubBundleBadQueryStringException|IaphubBundleBadQueryStringValueException
     */
    public function postUser(string $userId, array $payloadData, string $appId): void
    {
        $this->apiUri = str_replace([':userId', ':appId'], [$userId, $appId], self::POST_USER_URI);

        $this->validateBodyParameters($payloadData, __METHOD__);
        $this->post($payloadData);
    }

    /**
     * @param mixed[] $payloadData
     * @throws TransportExceptionInterface
     * @throws IaphubBundleBadQueryStringException
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface|IaphubBundleBadQueryStringValueException
     */
    public function postUserReceipt(string $userId, array $payloadData, string $appId): PostUserReceiptResponse
    {
        $this->apiUri = str_replace([':userId', ':appId'], [$userId, $appId], self::POST_USER_RECEIPT_URI);

        $this->validateBodyParameters($payloadData, __METHOD__);
        $response = $this->post($payloadData);

        self::verifyStatus($response);

        return PostUserReceiptResponseFactory::build($response->toArray());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public static function verifyStatus(ResponseInterface $response): void
    {
        $data = $response->toArray();
        if (isset($data['status']) && in_array($data['status'], ['failed', 'expired', 'invalid'])) {
            throw new Exception("Iaphub API success response but return {$data['status']} status .\nFind more details on your Iaphub dashboard");
        }
        if (isset($data['status']) && 'stale' === $data['status']) {
            throw new Exception("The purchase is stale, no purchase still valid where found");
        }
        if (isset($data['status']) && 'deferred' === $data['status']) {
            throw new Exception("The receipt is deferred, pending purchase detected, its final status is pending external action");
        }
    }

    /**
     * @throws IaphubApiResponseException
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function validResponse(ResponseInterface $response): void
    {
        if (200 !== $response->getStatusCode()) {
            throw new IaphubApiResponseException($this->method, $this->apiUri, $response->getStatusCode());
        }
        
        self::verifyStatus($response);
    }

    /**
     * @param mixed[]|null $queryParameters
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws IaphubBundleBadQueryStringException|IaphubBundleBadQueryStringValueException
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

        $this->validResponse($response);

        return PurchaseFactory::buildPurchase($response->toArray());
    }

    /**
     * @param mixed[]|null $queryParameters
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface|IaphubBundleBadQueryStringException|IaphubBundleBadQueryStringValueException
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

        $this->validResponse($response);

        return GetPurchasesFactory::build($response->toArray());
    }

    /**
     * @param mixed[]|null $queryParameters
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

        $this->validResponse($response);

        return PurchaseFactory::buildPurchase($response->toArray());
    }

    /**
     * @param mixed[]|null $queryParameters
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

        $this->validResponse($response);

        return ReceiptFactory::build($response->toArray());
    }

    /**
     * @param mixed[] $queryParameters
     * @throws IaphubBundleBadQueryStringException
     * @throws IaphubBundleBadQueryStringValueException
     */
    private function validateParameters(array $queryParameters, string $method): void
    {
        $this->getIaphubHttpClientValidationService()->validateParameters($queryParameters, $method, $this->apiUri);
    }

    /**
     * @param mixed[] $bodyParameters
     * @throws IaphubBundleBadQueryStringValueException
     * @throws IaphubBundleBadQueryStringException
     */
    private function validateBodyParameters(array $bodyParameters, string $method): void
    {
        $this->getIaphubHttpClientValidationService()->validateBodyParameters($bodyParameters, $method, $this->apiUri);
    }
}