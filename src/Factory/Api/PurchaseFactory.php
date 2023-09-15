<?php

namespace Johnkhansrc\IaphubBundle\Factory\Api;

use DateTime;
use Exception;
use Johnkhansrc\IaphubBundle\Model\Api\Purchase;

class PurchaseFactory
{
    /**
     * @param mixed[] $purchasesData
     * @return Purchase[]
     * @throws Exception
     */
    public static function buildPurchases(array $purchasesData): array
    {
        $purchases = [];
        foreach ($purchasesData as $purchaseData) {
            $purchases[] = self::buildPurchase($purchaseData);
        }

        return $purchases;
    }

    /**
     * @param mixed[] $purchaseData
     * @throws Exception
     */
    public static function buildPurchase(array $purchaseData): Purchase
    {
        return new Purchase(
            $purchaseData['id'],
            new DateTime($purchaseData['purchaseDate']),
            $purchaseData['quantity'],
            $purchaseData['platform'],
            $purchaseData['country'],
            $purchaseData['tags'],
            $purchaseData['orderId'],
            $purchaseData['app'],
            $purchaseData['user'],
            $purchaseData['userId'],
            $purchaseData['userIds'] ?? null,
            $purchaseData['receipt'],
            $purchaseData['androidToken'] ?? null,
            $purchaseData['product'],
            $purchaseData['productSku'],
            $purchaseData['productType'],
            $purchaseData['productGroupName'] ?? null,
            $purchaseData['listing'] ?? null,
            $purchaseData['store'] ?? null,
            $purchaseData['storeSegmentIndex'] ?? null,
            $purchaseData['currency'],
            $purchaseData['price'],
            $purchaseData['convertedCurrency'],
            $purchaseData['convertedPrice'],
            $purchaseData['isSandbox'],
            $purchaseData['isFamilyShare'],
            $purchaseData['isPromo'],
            $purchaseData['isRefunded'],
            isset($purchaseData['refundDate']) ? new DateTime($purchaseData['refundDate']) : null,
            $purchaseData['refundReason'] ?? null,
            $purchaseData['refundAmount'] ?? null,
            $purchaseData['convertedRefundAmount'] ?? null,
            $purchaseData['isSubscription'],
            $purchaseData['isSubscriptionActive'] ?? null,
            $purchaseData['isSubscriptionRenewable'] ?? null,
            $purchaseData['isSubscriptionRetryPeriod'] ?? null,
            $purchaseData['isSubscriptionGracePeriod'] ?? null,
            $purchaseData['isTrialConversion'] ?? null,
            $purchaseData['subscriptionState'] ?? null,
            $purchaseData['subscriptionPeriodType'] ?? null,
            $purchaseData['subscriptionCancelReason'] ?? null,
            $purchaseData['subscriptionProrationMode'] ?? null,
            $purchaseData['subscriptionRenewalProduct'] ?? null,
            $purchaseData['subscriptionRenewalProductSku'] ?? null,
            isset($purchaseData['expirationDate']) ? new DateTime($purchaseData['expirationDate']) : null,
            isset($purchaseData['autoResumeDate']) ? new DateTime($purchaseData['autoResumeDate']) : null,
            $purchaseData['nextPurchase'] ?? null,
            $purchaseData['linkedPurchase'] ?? null,
            $purchaseData['originalPurchase'] ?? null
        );
    }
}