<?php

namespace Johnkhansrc\IaphubBundle\Factory\Api;

use DateTime;
use Exception;
use Johnkhansrc\IaphubBundle\Model\Api\ActiveProducts;
use Johnkhansrc\IaphubBundle\Model\Api\GetUserApiResponse;
use Johnkhansrc\IaphubBundle\Model\Api\ProductsForSale;

class GetUserApiResponseFactory
{
    /**
     * @throws Exception
     */
    public static function build(array $payload): GetUserApiResponse
    {
        $productsForSaleData = $payload['productsForSale'];
        $productsForSale = [];
        $activeProductsData = $payload['activeProducts'];
        $activeProducts = [];
        $tags = $payload['tags'] ?? null;

        foreach ($productsForSaleData as $item) {
            $productsForSale[] = new ProductsForSale(
                $item['id'],
                $item['type'],
                $item['sku'],
                $item['group'] ?? null,
                $item['groupName'] ?? null,
                $item['subscriptionPeriodType'] ?? null,
            );
        }

        foreach ($activeProductsData as $item) {
            $activeProducts[] = new ActiveProducts(
                $item['id'],
                $item['type'],
                $item['sku'],
                $item['platform'] ?? null,
                $item['purchase'] ?? null,
                new DateTime($item['purchaseDate']),
                $item['isFamilyShare'] ?? null,
                $item['group'] ?? null,
                $item['groupName'] ?? null,
                isset($item['expirationDate']) ? new DateTime($item['expirationDate']) : null,
                isset($item['autoResumeDate']) ? new DateTime($item['autoResumeDate']) : null,
                $item['androidToken'] ?? null,
                $item['isSubscriptionRenewable'] ?? null,
                $item['isSubscriptionRetryPeriod'] ?? null,
                $item['subscriptionState'] ?? null,
                $item['subscriptionPeriodType'] ?? null,
            );
        }

        return new GetUserApiResponse($tags, $productsForSale, $activeProducts);
    }
}