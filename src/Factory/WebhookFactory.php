<?php

namespace Johnkhansrc\IaphubBundle\Factory;

use DateTime;
use Exception;
use Johnkhansrc\IaphubBundle\Model\Webhook\PurchaseWebhook;
use Johnkhansrc\IaphubBundle\Model\Webhook\RefundData;
use Johnkhansrc\IaphubBundle\Model\Webhook\SubscriptionData;
use Johnkhansrc\IaphubBundle\Model\Webhook\UserIdUpdateWebhook;
use Johnkhansrc\IaphubBundle\Model\Webhook\Webhook;
use Johnkhansrc\IaphubBundle\Model\Webhook\WebhookData;


class WebhookFactory
{
    /**
     * @param mixed[] $jsonPayload
     * @throws Exception
     */
    public static function build(array $jsonPayload): Webhook
    {
        if ('user_id_update' === $jsonPayload['type']) {
            return new UserIdUpdateWebhook(
                $jsonPayload['id'],
                $jsonPayload['version'],
                new DateTime($jsonPayload['createdDate']),
                $jsonPayload['oldUserId'],
                $jsonPayload['oldUserId'],
            );
        }

        $dataPayload = self::instanciateWebhookData($jsonPayload['data']);

        return new PurchaseWebhook(
            $jsonPayload['id'],
            $jsonPayload['type'],
            $jsonPayload['version'],
            new DateTime($jsonPayload['createdDate']),
            $dataPayload
        );
    }

    /**
     * @param mixed[] $dataPayload
     * @throws Exception
     */
    private static function instanciateWebhookData(array $dataPayload): WebhookData
    {
        return new WebhookData(
            $dataPayload['id'],
            new DateTime($dataPayload['purchaseDate']),
            $dataPayload['quantity'],
            $dataPayload['platform'],
            $dataPayload['country'],
            $dataPayload['tags'],
            $dataPayload['orderId'],
            $dataPayload['app'],
            $dataPayload['user'],
            $dataPayload['userId'],
            $dataPayload['receipt'] ?? null,
            $dataPayload['androidToken'] ?? null,
            $dataPayload['product'],
            $dataPayload['productSku'],
            $dataPayload['productType'],
            $dataPayload['productGroupName'] ?? null,
            $dataPayload['listing'] ?? '',
            $dataPayload['store'] ?? '',
            $dataPayload['storeSegmentIndex'] ?? null,
            $dataPayload['currency'],
            $dataPayload['price'],
            $dataPayload['convertedCurrency'],
            $dataPayload['convertedPrice'],
            $dataPayload['isSandbox'],
            $dataPayload['isFamilyShare'] ?? null,
            $dataPayload['isPromo'] ?? null,
            $dataPayload['isRefunded'],
            $dataPayload['isRefunded'] ? new RefundData(
                new DateTime($dataPayload['refundDate']),
                $dataPayload['refundReason'],
                $dataPayload['refundAmount'] ?? null,
                $dataPayload['convertedRefundAmount'] ?? null
            ) : null,
            $dataPayload['isSubscription'],
            $dataPayload['isSubscription'] ? new SubscriptionData(
                $dataPayload['isSubscriptionActive'],
                $dataPayload['isSubscriptionRenewable'],
                $dataPayload['isSubscriptionRetryPeriod'] ?? null,
                $dataPayload['isSubscriptionGracePeriod'] ?? null,
                $dataPayload['isTrialConversion'],
                $dataPayload['subscriptionState'],
                $dataPayload['subscriptionPeriodType'],
                $dataPayload['subscriptionCancelReason'] ?? null,
                $dataPayload['subscriptionProrationMode'] ?? null,
                $dataPayload['subscriptionRenewalProduct'] ?? null,
                $dataPayload['subscriptionRenewalProductSku'] ?? null,
                new DateTime($dataPayload['expirationDate']),
                isset($dataPayload['autoResumeDate']) ? new DateTime($dataPayload['autoResumeDate']) : null,
                $dataPayload['nextPurchase'] ?? null,
                $dataPayload['linkedPurchase'] ?? null,
                $dataPayload['originalPurchase'] ?? null
            ) : null,
        );
    }
}
