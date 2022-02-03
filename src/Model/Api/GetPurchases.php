<?php

namespace Johnkhansrc\IaphubBundle\Model\Api;

class GetPurchases
{
    /**
     * True if another page of results is available.
     */
    private bool $hasNextPage;
    /**
     * Purchases list.
     * @var Purchase[]
     */
    private array $purchases = [];

    /**
     * @param Purchase[] $purchases
     */
    public function __construct(bool $hasNextPage, array $purchases)
    {
        $this->hasNextPage = $hasNextPage;
        $this->purchases = $purchases;
    }

    /**
     * @return bool
     */
    public function isHasNextPage(): bool
    {
        return $this->hasNextPage;
    }

    /**
     * @param bool $hasNextPage
     * @return GetPurchases
     */
    public function setHasNextPage(bool $hasNextPage): GetPurchases
    {
        $this->hasNextPage = $hasNextPage;
        return $this;
    }

    /**
     * @return Purchase[]
     */
    public function getPurchases(): array
    {
        return $this->purchases;
    }

    /**
     * @param Purchase[] $purchases
     * @return GetPurchases
     */
    public function setPurchases(array $purchases): GetPurchases
    {
        $this->purchases = $purchases;
        return $this;
    }
}