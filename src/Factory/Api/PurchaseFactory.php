<?php

namespace Johnkhansrc\IaphubBundle\Factory\Api;

use DateTime;
use Exception;
use Johnkhansrc\IaphubBundle\Model\Api\Purchase;

class PurchaseFactory
{
    /**
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
            $purchaseData['androidToken'],
            $purchaseData['product'],
            $purchaseData['productSku'],
            $purchaseData['productType'],
            $purchaseData['productGroupName'] ?? null,
            $purchaseData['listing'],
            $purchaseData['store'],
            $purchaseData['storeSegmentIndex'],
            $purchaseData['currency'],
            $purchaseData['price'],
            $purchaseData['convertedCurrency'],
            $purchaseData['convertedPrice'],
            $purchaseData['isSandbox'],
            $purchaseData['isFamilyShare'],
            $purchaseData['isPromo'],
            $purchaseData['isRefunded'],
            new DateTime($purchaseData['refundDate']) ?? null,
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
            new DateTime($purchaseData['expirationDate']) ?? null,
            new DateTime($purchaseData['autoResumeDate']) ?? null,
            $purchaseData['nextPurchase'] ?? null,
            $purchaseData['linkedPurchase'] ?? null,
            $purchaseData['originalPurchase'] ?? null
        );
    }
}