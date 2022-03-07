<?php

namespace Johnkhansrc\IaphubBundle\Tests\Model;

use Johnkhansrc\IaphubBundle\Factory\Api\TransactionFactory;
use Johnkhansrc\IaphubBundle\Factory\WebhookFactory;
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

//        dump($this->decode());
//        if ('subscriptionCancelBodyMocks' === $mockName) {
//            dd($this->decode());
//        }

        echo "\nTest for $mockName payload";

        $webhook = WebhookFactory::build($this->decode());

        self::assertInstanceOf(PurchaseWebhook::class, $webhook);
    }

    public function testThis(): void
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
}
