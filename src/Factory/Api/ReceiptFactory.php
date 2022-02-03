<?php

namespace Johnkhansrc\IaphubBundle\Factory\Api;

use DateTime;
use Exception;
use Johnkhansrc\IaphubBundle\Model\Api\Receipt;

class ReceiptFactory
{
    /**
     * @throws Exception
     */
    public static function build(array $data): Receipt
    {
        return new Receipt(
            new DateTime($data['createdDate']),
            $data['processCount'],
            new DateTime($data['processedDate']),
            new DateTime($data['refreshDate']),
            $data['user'],
            $data['platform'],
            $data['status'],
            $data['token'],
            $data['sku']
        );
    }
}