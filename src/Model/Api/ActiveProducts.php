<?php

namespace Johnkhansrc\IaphubBundle\Model\Api;

use DateTime;

class ActiveProducts
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
     * Platform of the purchase.
     * @var null|string("ios", "android")
     */
    private ?string $platform;
    /**
     * Purchase id.
     */
    private ?string $purchase;
    /**
     * Date of the purchase.
     */
    private DateTime $purchaseDate;
    /**
     * True if it is shared by a family member (iOS only).
     */
    private ?bool $isFamilyShare;
    /**
     * Only if the product has a group
     * Group id.
     */
    private ?string $group;
    /**
     * Only if the product has a group
     * Group name.
     */
    private ?string $groupName;
    /**
     * Only for a subscription
     * Date of the subscription expiration.
     */
    private ?DateTime $expirationDate;
    /**
     * Only for a subscription
     * The subscription renewal has been paused, date the subscription will be automatically resumed (Android only).
     */
    private ?DateTime $autoResumeDate;
    /**
     * Only for a subscription
     * Android purchase token.
     */
    private ?string $androidToken;
    /**
     * Only for a subscription
     * True if the subscription is renewable.
     */
    private ?bool $isSubscriptionRenewable;
    /**
     * Only for a subscription
     * True if the subscription is currently trying to be renewed.
     */
    private ?bool $isSubscriptionRetryPeriod;
    /**
     * Only for a subscription
     * Current state of the subscription.
     * @var null|string("active", "grace_period", "retry_period", "paused")
     */
    private ?string $subscriptionState;
    /**
     * Only for a subscription
     * Current period type of the subscription.
     * @var null|string("normal", "intro", "trial")
     */
    private ?string $subscriptionPeriodType;

    public function __construct(string $id,
                                string $type,
                                string $sku,
                                ?string $platform,
                                ?string $purchase,
                                DateTime $purchaseDate,
                                ?bool $isFamilyShare,
                                ?string $group,
                                ?string $groupName,
                                ?DateTime $expirationDate,
                                ?DateTime $autoResumeDate,
                                ?string $androidToken,
                                ?bool $isSubscriptionRenewable,
                                ?bool $isSubscriptionRetryPeriod,
                                ?string $subscriptionState,
                                ?string $subscriptionPeriodType)
    {
        $this->id = $id;
        $this->type = $type;
        $this->sku = $sku;
        $this->platform = $platform;
        $this->purchase = $purchase;
        $this->purchaseDate = $purchaseDate;
        $this->isFamilyShare = $isFamilyShare;
        $this->group = $group;
        $this->groupName = $groupName;
        $this->expirationDate = $expirationDate;
        $this->autoResumeDate = $autoResumeDate;
        $this->androidToken = $androidToken;
        $this->isSubscriptionRenewable = $isSubscriptionRenewable;
        $this->isSubscriptionRetryPeriod = $isSubscriptionRetryPeriod;
        $this->subscriptionState = $subscriptionState;
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
     * @return ActiveProducts
     */
    public function setId(string $id): ActiveProducts
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
     * @return ActiveProducts
     */
    public function setType(string $type): ActiveProducts
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
     * @return ActiveProducts
     */
    public function setSku(string $sku): ActiveProducts
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     * @return ActiveProducts
     */
    public function setPlatform(string $platform): ActiveProducts
    {
        $this->platform = $platform;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPurchase(): ?string
    {
        return $this->purchase;
    }

    /**
     * @param string $purchase
     * @return ActiveProducts
     */
    public function setPurchase(string $purchase): ActiveProducts
    {
        $this->purchase = $purchase;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPurchaseDate(): DateTime
    {
        return $this->purchaseDate;
    }

    /**
     * @param DateTime $purchaseDate
     * @return ActiveProducts
     */
    public function setPurchaseDate(DateTime $purchaseDate): ActiveProducts
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isFamilyShare(): ?bool
    {
        return $this->isFamilyShare;
    }

    /**
     * @param bool $isFamilyShare
     * @return ActiveProducts
     */
    public function setIsFamilyShare(bool $isFamilyShare): ActiveProducts
    {
        $this->isFamilyShare = $isFamilyShare;
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
     * @return ActiveProducts
     */
    public function setGroup(?string $group): ActiveProducts
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
     * @return ActiveProducts
     */
    public function setGroupName(?string $groupName): ActiveProducts
    {
        $this->groupName = $groupName;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getExpirationDate(): ?DateTime
    {
        return $this->expirationDate;
    }

    /**
     * @param DateTime|null $expirationDate
     * @return ActiveProducts
     */
    public function setExpirationDate(?DateTime $expirationDate): ActiveProducts
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getAutoResumeDate(): ?DateTime
    {
        return $this->autoResumeDate;
    }

    /**
     * @param DateTime|null $autoResumeDate
     * @return ActiveProducts
     */
    public function setAutoResumeDate(?DateTime $autoResumeDate): ActiveProducts
    {
        $this->autoResumeDate = $autoResumeDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAndroidToken(): ?string
    {
        return $this->androidToken;
    }

    /**
     * @param string|null $androidToken
     * @return ActiveProducts
     */
    public function setAndroidToken(?string $androidToken): ActiveProducts
    {
        $this->androidToken = $androidToken;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsSubscriptionRenewable(): ?bool
    {
        return $this->isSubscriptionRenewable;
    }

    /**
     * @param bool|null $isSubscriptionRenewable
     * @return ActiveProducts
     */
    public function setIsSubscriptionRenewable(?bool $isSubscriptionRenewable): ActiveProducts
    {
        $this->isSubscriptionRenewable = $isSubscriptionRenewable;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsSubscriptionRetryPeriod(): ?bool
    {
        return $this->isSubscriptionRetryPeriod;
    }

    /**
     * @param bool|null $isSubscriptionRetryPeriod
     * @return ActiveProducts
     */
    public function setIsSubscriptionRetryPeriod(?bool $isSubscriptionRetryPeriod): ActiveProducts
    {
        $this->isSubscriptionRetryPeriod = $isSubscriptionRetryPeriod;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionState(): ?string
    {
        return $this->subscriptionState;
    }

    /**
     * @param string|null $subscriptionState
     * @return ActiveProducts
     */
    public function setSubscriptionState(?string $subscriptionState): ActiveProducts
    {
        $this->subscriptionState = $subscriptionState;
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
     * @return ActiveProducts
     */
    public function setSubscriptionPeriodType(?string $subscriptionPeriodType): ActiveProducts
    {
        $this->subscriptionPeriodType = $subscriptionPeriodType;
        return $this;
    }
}