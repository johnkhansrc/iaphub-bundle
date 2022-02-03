<?php

namespace Johnkhansrc\IaphubBundle\Model\Api;

class ProductsForSale
{
    /**
     * Product id.
     */
    private string $id;
    /**
     * Product type.
     */
    private string $type;
    /**
     * Product sku.
     */
    private string $sku;
    /**
     * Group id.
     */
    private ?string $group;
    /**
     * Only if the product has a group
     * Group name.
     */
    private ?string $groupName;
    /**
     * Only if the product has a group
     * Subscription period type, use this property to detect if there is an introductory price or free trial available.
     *     normal: No introductory offer.
     *     intro: Introductory price.
     *     trial: Free trial.
     * @var null|string("normal", "intro", "trial")
     */
    private ?string $subscriptionPeriodType;

    public function __construct(string $id,
                                string $type,
                                string $sku,
                                ?string $group,
                                ?string $groupName,
                                ?string $subscriptionPeriodType)
    {
        $this->id = $id;
        $this->type = $type;
        $this->sku = $sku;
        $this->group = $group;
        $this->groupName = $groupName;
        $this->subscriptionPeriodType = $subscriptionPeriodType;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return ProductsForSale
     */
    public function setId(string $id): ProductsForSale
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ProductsForSale
     */
    public function setType(string $type): ProductsForSale
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return ProductsForSale
     */
    public function setSku(string $sku): ProductsForSale
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @param string|null $group
     * @return ProductsForSale
     */
    public function setGroup(?string $group): ProductsForSale
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    /**
     * @param string|null $groupName
     * @return ProductsForSale
     */
    public function setGroupName(?string $groupName): ProductsForSale
    {
        $this->groupName = $groupName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionPeriodType(): ?string
    {
        return $this->subscriptionPeriodType;
    }

    /**
     * @param string|null $subscriptionPeriodType
     * @return ProductsForSale
     */
    public function setSubscriptionPeriodType(?string $subscriptionPeriodType): ProductsForSale
    {
        $this->subscriptionPeriodType = $subscriptionPeriodType;
        return $this;
    }
}