# iaphub-bundle
## An Iaphub integration for symfony application for receive webhooks and manage Iaphub API

_https://www.iaphub_


**Work in progress**

### Installation
Use Composer to install this bundle:
```
composer require johnkhansrc/iaphub-bundle:@dev
```

Add the bundle in your application kernel:
```php
// app/AppKernel.php

public function registerBundles()
{
    return [
        // ...
        Johnkhansrc\IaphubBundle\IaphubBundle::class => ['dev' => true],
        // ...
    ];
}
```

Add service configuration file
```yaml
#  config/packages/johnkhansrc_iaphub_bundle.yaml

johnkhansrc_iaphub:
  apikey: 'your-iaphub-api-key'
  webhook_auth_token: 'your-iaphub-webhook-auth-token'
```

Define your webhook URL
```yaml
#  config/routes/johnkhansrc_iaphub_bundle.yaml

_iaphub_bundle:
  resource: '@IaphubBundle/Ressources/config/routes.xml'
  prefix: '/iaphub/webhook_entrypoint'
```

### Usage

#### Webhooks
All webhook emit symfony event

Go webhooks documentation and design your market strategies.

| **Webhook**                      | **Event alias**                                 | **Event class**                          |
|----------------------------------|-------------------------------------------------|------------------------------------------|
| Purchase                         | iaphub.webhook.purchase                         | IaphubPurchaseEvent                      |
| Refund                           | iaphub.webhook.refund                           | IaphubRefundEvent                        |
| User id update                   | iaphub.webhook.user_id_update                   | IaphubUserIdUpdateEvent                  |
| Subscription renewal             | iaphub.webhook.subscription_renewal             | IaphubSubscriptionRenewalEvent           |
| Subscription renewal retry       | iaphub.webhook.subscription_renewal_retry       | IaphubSubscriptionRenewalRetryEvent      |
| Subscription grace period expire | iaphub.webhook.subscription_grace_period_expire | IaphubSubscriptionGracePeriodExpireEvent |
| Subscription product change      | iaphub.webhook.subscription_product_change      | IaphubSubscriptionProductChangeEvent     |
| Subscription replace             | iaphub.webhook.subscription_replace             | IaphubSubscriptionReplaceEvent           |
| Subscription cancel              | iaphub.webhook.subscription_cancel              | IaphubSubscriptionCancelEvent            |
| Subscription uncancel            | iaphub.webhook.subscription_uncancel            | IaphubSubscriptionUnCancelEvent          |
| Subscription expire              | iaphub.webhook.subscription_expire              | IaphubSubscriptionExpireEvent            |
| Subscription pause               | iaphub.webhook.subscription_pause               | IaphubSubscriptionPauseEvent             |
| Subscription pause enabled       | iaphub.webhook.subscription_pause_enabled       | IaphubSubscriptionPauseEnabledEvent      |
| Subscription pause disabled      | iaphub.webhook.subscription_pause_disabled      | IaphubSubscriptionPauseDisabledEvent     |

eq (for an EventSubscriberInterface)
```php
    public static function getSubscribedEvents(): array
    {
        return [
            IaphubPurchaseEvent::NAME => ['onIaphubPurchaseEvent', 1],
            IaphubRefundEvent::NAME => ['onIaphubRefundEvent', 1],
            IaphubUserIdUpdateEvent::NAME => ['onIaphubUserIdUpdateEvent', 1],
            IaphubSubscriptionRenewalEvent::NAME => ['onIaphubSubscriptionRenewalEvent', 1],
            IaphubSubscriptionRenewalRetryEvent::NAME => ['onIaphubSubscriptionRenewalRetryEvent', 1],
            IaphubSubscriptionGracePeriodExpireEvent::NAME => ['onIaphubSubscriptionGracePeriodExpireEvent', 1],
            IaphubSubscriptionProductChangeEvent::NAME => ['onIaphubSubscriptionProductChangeEvent', 1],
            IaphubSubscriptionReplaceEvent::NAME => ['onIaphubSubscriptionReplaceEvent', 1],
            IaphubSubscriptionCancelEvent::NAME => ['onIaphubSubscriptionCancelEvent', 1],
            IaphubSubscriptionUnCancelEvent::NAME => ['onIaphubSubscriptionUnCancelEvent', 1],
            IaphubSubscriptionExpireEvent::NAME => ['onIaphubSubscriptionExpireEvent', 1],
            IaphubSubscriptionPauseEvent::NAME => ['onIaphubSubscriptionPauseEvent', 1],
            IaphubSubscriptionPauseEnabledEvent::NAME => ['onIaphubSubscriptionPauseEnabledEvent', 1],
            IaphubSubscriptionPauseDisabledEvent::NAME => ['onIaphubSubscriptionPauseDisabledEvent', 1],
        ];
    }
```



#### Iaphub API
All API method is provided from the **Johnkhansrc\IaphubBundle\Iaphub** public service.

**Get the client**

eq
```php
public function __construct(Iaphub $iaphub)
{
    $client = $iaphub->apiClient();
    
    $purchaseId = 'XXXX';
    $appId = 'ZZZZ';
    
    $client->getSubscription($purchaseId, $appId);
}
```

**Methods**
```php
    /**
     * https://www.iaphub.com/docs/api/get-user
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws Exception
     */
    public function getUser(string $userId, string $appId, ?array $queryParameters = null): GetUserApiResponse

    /**
     * https://www.iaphub.com/docs/api/get-user-migrate
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface|IaphubBundleBadQueryStringException
     */
    public function getUserMigrate(string $userId, string $appId, ?array $queryParameters = null): string

    /**
     * https://www.iaphub.com/docs/api/post-user
     * @throws TransportExceptionInterface
     * @throws IaphubBundleBadQueryStringException
     */
    public function postUser(string $userId, array $payloadData, string $appId): void

    /**
     * https://www.iaphub.com/docs/api/post-user-receipt
     * @throws TransportExceptionInterface
     * @throws IaphubBundleBadQueryStringException
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function postUserReceipt(string $userId, array $payloadData, string $appId): PostUserReceiptResponse

    /**
     * https://www.iaphub.com/docs/api/get-purchase
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws IaphubBundleBadQueryStringException
     */
    public function getPurchase(string $purchaseId, string $appId, ?array $queryParameters = null): Purchase

    /**
     * https://www.iaphub.com/docs/api/get-purchases
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface|IaphubBundleBadQueryStringException
     */
    public function getPurchases(string $appId, ?array $queryParameters = null): GetPurchases

    /**
     * https://www.iaphub.com/docs/api/get-subscription
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface|IaphubBundleBadQueryStringException
     * @throws Exception
     */
    public function getSubscription(string $originalPurchaseId, string $appId, ?array $queryParameters = null): Purchase

    /**
     * https://www.iaphub.com/docs/api/get-receipt
     * @throws IaphubApiResponseException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws Exception
     */
    public function getReceipt(string $receiptId, string $appId, ?array $queryParameters = null): Receipt
```
