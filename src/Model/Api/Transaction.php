<?php

namespace Johnkhansrc\IaphubBundle\Model\Api;

use DateTime;

class Transaction
{
    /**
     * Product id.
     */
    private string $id;
    /**
     * Product sku.
     */
    private string $sku;
    /**
     * Purchase id.
     */
    private string $purchase;
    /**
     * Purchase date.
     */
    private DateTime $purchaseDate;
    /**
     * Webhook status.
     *     success: The webhook has been sent successfully.
     *     failed: The webhook has failed.
     * @var string("success", "failed")
     */
    private ?string $webhookStatus;
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
     * True if the subscription is renewable (false if the subscription has been cancelled).
     */
    private ?bool $isSubscriptionRenewable;
    /**
     * Only for a subscription
     * True if the subscription is currently trying to be renewed.
     */
    private ?bool $isSubscriptionRetryPeriod;
    /**
     * Only for a subscription
     * Current period type of the subscription.
     */
    private ?string $subscriptionPeriodType;

    public function __construct(string $id,
                                string $sku,
                                string $purchase,
                                DateTime $purchaseDate,
                                ?string $webhookStatus,
                                ?string $group,
                                ?string $groupName,
                                ?DateTime $expirationDate,
                                ?DateTime $autoResumeDate,
                                ?bool $isSubscriptionRenewable,
                                ?bool $isSubscriptionRetryPeriod,
                                ?string $subscriptionPeriodType)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->purchase = $purchase;
        $this->purchaseDate = $purchaseDate;
        $this->webhookStatus = $webhookStatus;
        $this->group = $group;
        $this->groupName = $groupName;
        $this->expirationDate = $expirationDate;
        $this->autoResumeDate = $autoResumeDate;
        $this->isSubscriptionRenewable = $isSubscriptionRenewable;
        $this->isSubscriptionRetryPeriod = $isSubscriptionRetryPeriod;
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
     * @return Transaction
     */
    public function setId(string $id): Transaction
    {
        $this->id = $id;
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
     * @return Transaction
     */
    public function setSku(string $sku): Transaction
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurchase(): string
    {
        return $this->purchase;
    }

    /**
     * @param string $purchase
     * @return Transaction
     */
    public function setPurchase(string $purchase): Transaction
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
     * @return Transaction
     */
    public function setPurchaseDate(DateTime $purchaseDate): Transaction
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebhookStatus(): ?string
    {
        return $this->webhookStatus;
    }

    /**
     * @param string $webhookStatus
     * @return Transaction
     */
    public function setWebhookStatus(?string $webhookStatus): Transaction
    {
        $this->webhookStatus = $webhookStatus;
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
     * @return Transaction
     */
    public function setGroup(?string $group): Transaction
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
     * @return Transaction
     */
    public function setGroupName(?string $groupName): Transaction
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
     * @return Transaction
     */
    public function setExpirationDate(?DateTime $expirationDate): Transaction
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
     * @return Transaction
     */
    public function setAutoResumeDate(?DateTime $autoResumeDate): Transaction
    {
        $this->autoResumeDate = $autoResumeDate;
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
     * @return Transaction
     */
    public function setIsSubscriptionRenewable(?bool $isSubscriptionRenewable): Transaction
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
     * @return Transaction
     */
    public function setIsSubscriptionRetryPeriod(?bool $isSubscriptionRetryPeriod): Transaction
    {
        $this->isSubscriptionRetryPeriod = $isSubscriptionRetryPeriod;
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
     * @return Transaction
     */
    public function setSubscriptionPeriodType(?string $subscriptionPeriodType): Transaction
    {
        $this->subscriptionPeriodType = $subscriptionPeriodType;
        return $this;
    }
}