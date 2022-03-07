<?php

namespace Johnkhansrc\IaphubBundle\Factory\Api;

use DateTime;
use Exception;
use Johnkhansrc\IaphubBundle\Model\Api\Transaction;

class TransactionFactory
{
    /**
     * @throws Exception
     */
    public static function build(array $data): Transaction
    {
        return new Transaction(
            $data['id'],
            $data['sku'],
            $data['purchase'],
            new DateTime($data['purchaseDate']),
            $data['webhookStatus'] ?? null,
            $data['group'] ?? null,
            $data['groupName'] ?? null,
            isset($data['expirationDate']) ? new DateTime($data['expirationDate']) : null,
            isset($data['autoResumeDate']) ? new DateTime($data['autoResumeDate']) : null,
            $data['isSubscriptionRenewable'] ?? null,
            $data['isSubscriptionRetryPeriod'] ?? null,
            $data['subscriptionPeriodType'] ?? null,
        );
    }
}