<?php

namespace Johnkhansrc\IaphubBundle\Model\Webhook;

use DateTime;

/**
 * Only if WebhookData::isSubscription is true.
 */
class SubscriptionData
{
    /**
     * True if the subscription is currently active.
     */
    private bool $isSubscriptionActive;
    /**
     * True if the subscription is renewable.
     */
    private bool $isSubscriptionRenewable;
    /**
     * True if the subscription is currently trying to be renewed.
     */
    private ?bool $isSubscriptionRetryPeriod;
    /**
     * True if the subscription is currently in a grace period.
     */
    private ?bool $isSubscriptionGracePeriod;
    /**
     * True if the purchase is the conversion of a trial.
     */
    private bool $isTrialConversion;
    /**
     * Current state of the subscription.
     *     active: Active
     *     grace_period: In a grace period
     *     retry_period: In a retry period
     *     paused: paused
     *     expired: expired
     * @var string("active", "grace_period", "retry_period", "paused", "expired")
     */
    private string $subscriptionState;
    /**
     * Period type of the subscription.
     *     normal: Normal subscription.
     *     trial: Trial subscription.
     *     intro: Introductory subscription.
     * @var string("normal", "trial", "intro")
     */
    private string $subscriptionPeriodType;
    /**
     * Reason of the renewable subscription cancellation.
     *     refunded: The purchase has been refunded.
     *     customer_cancelled: The customer canceled the subscription.
     *     developer_cancelled: The canceled the subscription.
     *     subscription_replaced: The subscription has been replaced.
     *     rejected_price_increase: Customer did not agree to a recent price increase (Ios only).
     *     billing_error: Billing error, the customer's payment information was no longer valid for example.
     *     product_not_available: Product was not available for purchase at the time of renewal (Ios only).
     *     unknown: Unknown error.
     * @var string(
     *     "refunded",
     *     "customer_cancelled",
     *     "developer_cancelled",
     *     "subscription_replaced",
     *     "rejected_price_increase",
     *     "billing_error",
     *     "product_not_available",
     *     "unknown")
     */
    private ?string $subscriptionCancelReason;
    /**
     * Only when the transaction has been created because of a subscription replace.
     *     immediate_with_time_proration: The replacement takes effect immediately,
     *         the remaining time will be prorated for the new subscription.
     *     immediate_and_charge_prorated_price: The replacement takes effect immediately,
     *         the price of the previous subscription will be prorated (partial refund).
     *     immediate_without_proration: The replacement takes effect immediately with no extra charge,
     *         the new price will be charged on next recurrence time.
     * @var null|string("immediate_with_time_proration",
     *     "immediate_and_charge_prorated_price",
     *     "immediate_without_proration")
     */
    private ?string $subscriptionProrationMode;
    /**
     * Product id of next renewal.
     */
    private ?string $subscriptionRenewalProduct;
    /**
     * Product sku of next renewal.
     */
    private ?string $subscriptionRenewalProductSku;
    /**
     * Date of the subscription expiration.
     */
    private DateTime $expirationDate;
    /**
     * The subscription renewal has been paused, date the subscription will be automatically resumed (Android only).
     */
    private ?DateTime $autoResumeDate;
    /**
     * Next purchase id of a renewable subscription.
     */
    private ?string $nextPurchase;
    /**
     * Previous purchase id of a renewable subscription.
     */
    private ?string $linkedPurchase;
    /**
     * Original purchase id of a renewable subscription.
     */
    private ?string $originalPurchase;

    public function __construct(
        bool $isSubscriptionActive,
        bool $isSubscriptionRenewable,
        ?bool $isSubscriptionRetryPeriod,
        ?bool $isSubscriptionGracePeriod,
        bool $isTrialConversion,
        string $subscriptionState,
        string $subscriptionPeriodType,
        ?string $subscriptionCancelReason,
        ?string $subscriptionProrationMode,
        ?string $subscriptionRenewalProduct,
        ?string $subscriptionRenewalProductSku,
        DateTime $expirationDate,
        ?DateTime $autoResumeDate,
        ?string $nextPurchase,
        ?string $linkedPurchase,
        ?string $originalPurchase
    )
    {
        $this->isSubscriptionActive = $isSubscriptionActive;
        $this->isSubscriptionRenewable = $isSubscriptionRenewable;
        $this->isSubscriptionRetryPeriod = $isSubscriptionRetryPeriod;
        $this->isSubscriptionGracePeriod = $isSubscriptionGracePeriod;
        $this->isTrialConversion = $isTrialConversion;
        $this->subscriptionState = $subscriptionState;
        $this->subscriptionPeriodType = $subscriptionPeriodType;
        $this->subscriptionCancelReason = $subscriptionCancelReason;
        $this->subscriptionProrationMode = $subscriptionProrationMode;
        $this->subscriptionRenewalProduct = $subscriptionRenewalProduct;
        $this->subscriptionRenewalProductSku = $subscriptionRenewalProductSku;
        $this->expirationDate = $expirationDate;
        $this->autoResumeDate = $autoResumeDate;
        $this->nextPurchase = $nextPurchase;
        $this->linkedPurchase = $linkedPurchase;
        $this->originalPurchase = $originalPurchase;
    }

    /**
     * @return bool
     */
    public function isSubscriptionActive(): bool
    {
        return $this->isSubscriptionActive;
    }

    /**
     * @param bool $isSubscriptionActive
     * @return SubscriptionData
     */
    public function setIsSubscriptionActive(bool $isSubscriptionActive): SubscriptionData
    {
        $this->isSubscriptionActive = $isSubscriptionActive;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSubscriptionRenewable(): bool
    {
        return $this->isSubscriptionRenewable;
    }

    /**
     * @param bool $isSubscriptionRenewable
     * @return SubscriptionData
     */
    public function setIsSubscriptionRenewable(bool $isSubscriptionRenewable): SubscriptionData
    {
        $this->isSubscriptionRenewable = $isSubscriptionRenewable;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isSubscriptionRetryPeriod(): ?bool
    {
        return $this->isSubscriptionRetryPeriod;
    }

    /**
     * @param bool|null $isSubscriptionRetryPeriod
     * @return SubscriptionData
     */
    public function setIsSubscriptionRetryPeriod(?bool $isSubscriptionRetryPeriod): SubscriptionData
    {
        $this->isSubscriptionRetryPeriod = $isSubscriptionRetryPeriod;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function isSubscriptionGracePeriod(): ?bool
    {
        return $this->isSubscriptionGracePeriod;
    }

    /**
     * @param null|bool $isSubscriptionGracePeriod
     * @return SubscriptionData
     */
    public function setIsSubscriptionGracePeriod(?bool $isSubscriptionGracePeriod): SubscriptionData
    {
        $this->isSubscriptionGracePeriod = $isSubscriptionGracePeriod;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTrialConversion(): bool
    {
        return $this->isTrialConversion;
    }

    /**
     * @param bool $isTrialConversion
     * @return SubscriptionData
     */
    public function setIsTrialConversion(bool $isTrialConversion): SubscriptionData
    {
        $this->isTrialConversion = $isTrialConversion;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscriptionState(): string
    {
        return $this->subscriptionState;
    }

    /**
     * @param string $subscriptionState
     * @return SubscriptionData
     */
    public function setSubscriptionState(string $subscriptionState): SubscriptionData
    {
        $this->subscriptionState = $subscriptionState;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscriptionPeriodType(): string
    {
        return $this->subscriptionPeriodType;
    }

    /**
     * @param string $subscriptionPeriodType
     * @return SubscriptionData
     */
    public function setSubscriptionPeriodType(string $subscriptionPeriodType): SubscriptionData
    {
        $this->subscriptionPeriodType = $subscriptionPeriodType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionCancelReason(): ?string
    {
        return $this->subscriptionCancelReason;
    }

    /**
     * @param string|null $subscriptionCancelReason
     * @return SubscriptionData
     */
    public function setSubscriptionCancelReason(?string $subscriptionCancelReason): SubscriptionData
    {
        $this->subscriptionCancelReason = $subscriptionCancelReason;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionProrationMode(): ?string
    {
        return $this->subscriptionProrationMode;
    }

    /**
     * @param string|null $subscriptionProrationMode
     * @return SubscriptionData
     */
    public function setSubscriptionProrationMode(?string $subscriptionProrationMode): SubscriptionData
    {
        $this->subscriptionProrationMode = $subscriptionProrationMode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionRenewalProduct(): ?string
    {
        return $this->subscriptionRenewalProduct;
    }

    /**
     * @param string|null $subscriptionRenewalProduct
     * @return SubscriptionData
     */
    public function setSubscriptionRenewalProduct(?string $subscriptionRenewalProduct): SubscriptionData
    {
        $this->subscriptionRenewalProduct = $subscriptionRenewalProduct;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionRenewalProductSku(): ?string
    {
        return $this->subscriptionRenewalProductSku;
    }

    /**
     * @param string|null $subscriptionRenewalProductSku
     * @return SubscriptionData
     */
    public function setSubscriptionRenewalProductSku(?string $subscriptionRenewalProductSku): SubscriptionData
    {
        $this->subscriptionRenewalProductSku = $subscriptionRenewalProductSku;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

    /**
     * @param DateTime $expirationDate
     * @return SubscriptionData
     */
    public function setExpirationDate(DateTime $expirationDate): SubscriptionData
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
     * @return SubscriptionData
     */
    public function setAutoResumeDate(?DateTime $autoResumeDate): SubscriptionData
    {
        $this->autoResumeDate = $autoResumeDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNextPurchase(): ?string
    {
        return $this->nextPurchase;
    }

    /**
     * @param string|null $nextPurchase
     * @return SubscriptionData
     */
    public function setNextPurchase(?string $nextPurchase): SubscriptionData
    {
        $this->nextPurchase = $nextPurchase;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLinkedPurchase(): ?string
    {
        return $this->linkedPurchase;
    }

    /**
     * @param null|string $linkedPurchase
     * @return SubscriptionData
     */
    public function setLinkedPurchase(?string $linkedPurchase): SubscriptionData
    {
        $this->linkedPurchase = $linkedPurchase;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOriginalPurchase(): ?string
    {
        return $this->originalPurchase;
    }

    /**
     * @param null|string $originalPurchase
     * @return SubscriptionData
     */
    public function setOriginalPurchase(?string $originalPurchase): SubscriptionData
    {
        $this->originalPurchase = $originalPurchase;
        return $this;
    }
}
