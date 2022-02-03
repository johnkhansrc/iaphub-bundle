<?php

namespace Johnkhansrc\IaphubBundle\Model\Api;

class GetUserApiResponse
{
    /**
     * User tags.
     */
    private ?array $tags;
    /**
     * User's products available for sale.
     * @var ProductsForSale[]
     */
    private array $productsForSale;
    /**
     * User active subscriptions or non-consumables.
     * @var ActiveProducts[]
     */
    private array $activeProducts;

    /**
     * @param array|null $tags
     * @param ProductsForSale[] $productsForSale
     * @param ActiveProducts[] $activeProducts
     */
    public function __construct(?array $tags, array $productsForSale, array $activeProducts)
    {
        $this->tags = $tags;
        $this->productsForSale = $productsForSale;
        $this->activeProducts = $activeProducts;
    }

    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array|null $tags
     * @return GetUserApiResponse
     */
    public function setTags(?array $tags): GetUserApiResponse
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return ProductsForSale[]
     */
    public function getProductsForSale(): array
    {
        return $this->productsForSale;
    }

    /**
     * @param ProductsForSale[] $productsForSale
     * @return GetUserApiResponse
     */
    public function setProductsForSale(array $productsForSale): GetUserApiResponse
    {
        $this->productsForSale = $productsForSale;
        return $this;
    }

    /**
     * @return ActiveProducts[]
     */
    public function getActiveProducts(): array
    {
        return $this->activeProducts;
    }

    /**
     * @param ActiveProducts[] $activeProducts
     * @return GetUserApiResponse
     */
    public function setActiveProducts(array $activeProducts): GetUserApiResponse
    {
        $this->activeProducts = $activeProducts;
        return $this;
    }
}