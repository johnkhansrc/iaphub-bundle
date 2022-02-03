<?php

namespace Johnkhansrc\IaphubBundle\Factory\Api;

use Johnkhansrc\IaphubBundle\Model\Api\GetPurchases;

class GetPurchasesFactory
{
    /**
     * @throws \Exception
     */
    public static function build(array $data): GetPurchases
    {
        return new GetPurchases($data['hasNextPage'], PurchaseFactory::buildPurchases($data['list']));
    }
}