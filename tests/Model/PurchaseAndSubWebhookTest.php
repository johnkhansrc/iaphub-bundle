<?php

namespace Johnkhansrc\IaphubBundle\Tests\Model;

use Johnkhansrc\IaphubBundle\Factory\WebhookFactory;
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
}
