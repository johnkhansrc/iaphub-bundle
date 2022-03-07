<?php

namespace Johnkhansrc\IaphubBundle\Tests\Model;

use Johnkhansrc\IaphubBundle\Factory\Api\PurchaseFactory;
use Johnkhansrc\IaphubBundle\Factory\Api\TransactionFactory;
use Johnkhansrc\IaphubBundle\Factory\WebhookFactory;
use Johnkhansrc\IaphubBundle\Model\Api\Purchase;
use Johnkhansrc\IaphubBundle\Model\Api\Transaction;
use Johnkhansrc\IaphubBundle\Model\Webhook\PurchaseWebhook;
use JsonException;

class PurchaseAndSubWebhookTest extends FactoryTestCase
{
    /**
     * @throws JsonException
     */
    public function testInstantiatePurchaseAndSubWebhooks(): void
    {
        $mockNames = [
            'subscriptionCancelBodyMocks',
            'subscriptionExpireBodyMocks',
            'subscriptionGracePeriodeExpireBodyMocks',
            'subscriptionPauseBodyMocks',
            'subscriptionPauseDisabledBodyMocks',
            'subscriptionPauseEnabledBodyMocks',
            'subscriptionProductChangeBodyMocks',
            'subscriptionRenewalBodyMocks',
            'subscriptionRenewalRetryBodyMocks',
            'subscriptionReplaceBodyMocks',
            'subscriptionUnCancelBodyMocks',
            'purchaseBodyMocks',
            'refundBodyMocks',
        ];

        foreach ($mockNames as $mockName) {
            $this->assertSuccessfullyInstantiatePurchaseAndSubWebhook($mockName);
        }
    }

    /**
     * @throws JsonException
     */
    private function assertSuccessfullyInstantiatePurchaseAndSubWebhook(string $mockName): void
    {
        $this->mockName = $mockName;

        echo "\nTest for $mockName payload";

        $webhook = WebhookFactory::build($this->decode());

        self::assertInstanceOf(PurchaseWebhook::class, $webhook);
    }

    public function testTransactionFactory(): void
    {
        $transactionData = [
            "id" => "XXXXXX",
            "sku" => "XXXXX",
            "type" => "renewable_subscription",
            "purchase" => "XXXXX",
            "purchaseDate" => "2022-01-20T07:59:58.061Z",
            "user" => "XXXXX",
            "group" => "XXXXX",
            "groupName" => "Group XXXX",
            "expirationDate" => "2022-04-20T07:53:19.057Z",
            "subscriptionState" => "active",
            "subscriptionPeriodType" => "normal",
            "isSubscriptionRenewable" => false,
            "isSubscriptionRetryPeriod" => false,
            "isSubscriptionGracePeriod" => false
        ];

        self::assertInstanceOf(Transaction::class, TransactionFactory::build($transactionData));
    }

    public function testPurchaseFactory(): void
    {
        $datas = [
            "id" => "xxx",
            "purchaseDate" => "2022-03-07T11:56:43.000Z",
            "quantity" => 1,
            "platform" => "ios",
            "country" => "XX",
            "orderId" => "xxx",
            "app" => "xxxx",
            "user" => "xxxx",
            "product" => "xxx",
            "receipt" => "xxx",
            "currency" => "EUR",
            "price" => 29.99,
            "convertedCurrency" => "EUR",
            "convertedPrice" => 29.99,
            "isSandbox" => false,
            "isRefunded" => false,
            "isFamilyShare" => false,
            "isPromo" => false,
            "isSubscription" => true,
            "isSubscriptionActive" => true,
            "isSubscriptionRenewable" => true,
            "isSubscriptionRetryPeriod" => false,
            "isSubscriptionGracePeriod" => false,
            "isSubscriptionPaused" => false,
            "isTrialConversion" => false,
            "subscriptionState" => "active",
            "subscriptionPeriodType" => "normal",
            "expirationDate" => "2022-06-07T10:56:43.000Z",
            "linkedPurchase" => "xxxx",
            "originalPurchase" => "xxxx",
            "tags" => [],
            "userId" => "xxx",
            "productSku" => "xxxx",
            "productType" => "renewable_subscription",
            "productGroupName" => "Group 1"
        ];

        self::assertInstanceOf(Purchase::class, PurchaseFactory::buildPurchase($datas));
    }
}
