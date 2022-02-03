<?php

namespace Johnkhansrc\IaphubBundle\Model\Api;

use DateTime;

class Purchase
{
    /**
     * Id of the purchase.
     */
    private string $id;
    /**
     * Date of purchase.
     */
    private DateTime $purchaseDate;
    /**
     * Quantity.
     */
    private int $quantity;
    /**
     * Platform.
     * @var string("ios", "android")
     */
    private string $platform;
    /**
     * Country of the user on purchase.
     */
    private string $country;
    /**
     * Tags of the user on purchase.
     */
    private array $tags;
    /**
     * IOS/Android order id of the purchase.
     */
    private string $orderId;
    /**
     * App id.
     */
    private string $app;
    /**
     * User id (from IAPHUB).
     */
    private string $user;
    /**
     * User id (you provided at login) of the user that purchased the product.
     */
    private string $userId;
    /**
     * Only if the mode allowing an user to have multiple user ids is enabled
     * User ids of the user owning the purchase (A purchase can be owned by multiple user ids if restored).
     */
    private ?array $userIds;
    /**
     * Receipt id.
     */
    private string $receipt;
    /**
     * Android purchase token.
     */
    private string $androidToken;
    /**
     * Product id.
     */
    private string $product;
    /**
     * Product sku.
     */
    private string $productSku;
    /**
     * Product type of the purchase.
     *     consumable: Consumable product.
     *     non_consumable: Non-consumable product.
     *     renewable_subscription: Auto-renewable subscription.
     *     subscription: Non-renewing subscription.
     * @var string("consumable", "non_consumable", "renewable_subscription", "subscription")
     */
    private string $productType;
    /**
     * Only if the product has a group
     * Product group name.
     */
    private ?string $productGroupName;
    /**
     * Listing id.
     */
    private string $listing;
    /**
     * Store id.
     */
    private string $store;
    /**
     * Store segment index (when a store is used for testing, 0 by default).
     */
    private int $storeSegmentIndex;
    /**
     * Price currency.
     */
    private string $currency;
    /**
     * Price amount
     */
    private float $price;
    /**
     * Currency configured on your app settings.
     */
    private string $convertedCurrency;
    /**
     * Price amount converted to the currency of your app.
     */
    private float $convertedPrice;
    /**
     * True if it is a sandbox purchase.
     */
    private bool $isSandbox;
    /**
     * True if it is shared by a family member (iOS only).
     */
    private bool $isFamilyShare;
    /**
     * True if it has been purchased from a promo code.
     */
    private bool $isPromo;
    /**
     * True if the purchase has been refunded.
     */
    private bool $isRefunded;
    /**
     * Only if isRefunded is true
     * Date of the refund.
     */
    private ?DateTime $refundDate;
    /**
     * Only if isRefunded is true
     * Reason of the refund.
     *     subscription_replaced: The subscription has been replaced.
     *     other:  Other reason.
     *     issue: The refund has been issued because of an issue reported to the Apple customer support (IOS only).
     *     remorse: Remorse (Android only).
     *     not_received: Not received (Android only).
     *     defective: Defective (Android only).
     *     accidental_purchase: Accidental purchase (Android only).
     *     fraud: Fraud (Android only).
     *     friendly_fraud: Friendly fraud (Android only).
     *     chargeback: Chargeback (Android only).
     * @var null|string(
     *     "subscription_replaced",
     *     "other",
     *     "issue",
     *     "remorse",
     *     "not_received",
     *     "defective",
     *     "accidental_purchase",
     *     "fraud",
     *     "friendly_fraud",
     *     "chargeback")
     */
    private ?string $refundReason;
    /**
     * Only if isRefunded is true
     * Refund amount (using the currency of purchase).
     */
    private ?float $refundAmount;
    /**
     * Only if isRefunded is true
     * Refund amount (using the converted currency).
     */
    private ?float $convertedRefundAmount;
    /**
     * True if it is a subscription.
     */
    private bool $isSubscription;
    /**
     * Only if isSubscription is true
     * True if the subscription is currently active.
     */
    private ?bool $isSubscriptionActive;
    /**
     * Only if isSubscription is true
     * True if the subscription is renewable.
     */
    private ?bool $isSubscriptionRenewable;
    /**
     * Only if isSubscription is true
     * True if the subscription is currently trying to be renewed.
     */
    private ?bool $isSubscriptionRetryPeriod;
    /**
     * Only if isSubscription is true
     * True if the subscription is currently in a grace period.
     */
    private ?bool $isSubscriptionGracePeriod;
    /**
     * Only if isSubscription is true
     * True if the purchase is the conversion of a trial.
     */
    private ?bool $isTrialConversion;
    /**
     * Only if isSubscription is true
     * Current state of the subscription.
     * @var null|string("active", "grace_period", "retry_period", "paused")
     */
    private ?string $subscriptionState;
    /**
     * Only if isSubscription is true
     * Period type of the subscription.
     * @var null|string("normal", "intro", "trial")
     */
    private ?string $subscriptionPeriodType;
    /**
     * Only if isSubscription is true
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
     * Only if isSubscription is true
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
     * Only if isSubscription is true
     * Product id of next renewal.
     */
    private ?string $subscriptionRenewalProduct;
    /**
     * Only if isSubscription is true
     * Product sku of next renewal.
     */
    private ?string $subscriptionRenewalProductSku;
    /**
     * Only if isSubscription is true
     * Date of the subscription expiration.
     */
    private ?DateTime $expirationDate;
    /**
     * Only if isSubscription is true
     * The subscription renewal has been paused, date the subscription will be automatically resumed (Android only).
     */
    private ?DateTime $autoResumeDate;
    /**
     * Only if isSubscription is true
     * Next purchase id of a renewable subscription.
     */
    private ?string $nextPurchase;
    /**
     * Only if isSubscription is true
     * Previous purchase id of a renewable subscription.
     */
    private ?string $linkedPurchase;
    /**
     * Only if isSubscription is true
     * Original purchase id of a renewable subscription.
     */
    private ?string $originalPurchase;

    public function __construct(string $id,
                                DateTime $purchaseDate,
                                int $quantity,
                                string $platform,
                                string $country,
                                array $tags,
                                string $orderId,
                                string $app,
                                string $user,
                                string $userId,
                                ?array $userIds,
                                string $receipt,
                                string $androidToken,
                                string $product,
                                string $productSku,
                                string $productType,
                                ?string $productGroupName,
                                string $listing,
                                string $store,
                                int $storeSegmentIndex,
                                string $currency,
                                float $price,
                                string $convertedCurrency,
                                float $convertedPrice,
                                bool $isSandbox,
                                bool $isFamilyShare,
                                bool $isPromo,
                                bool $isRefunded,
                                ?DateTime $refundDate,
                                ?string $refundReason,
                                ?float $refundAmount,
                                ?float $convertedRefundAmount,
                                bool $isSubscription,
                                ?bool $isSubscriptionActive,
                                ?bool $isSubscriptionRenewable,
                                ?bool $isSubscriptionRetryPeriod,
                                ?bool $isSubscriptionGracePeriod,
                                ?bool $isTrialConversion,
                                ?string $subscriptionState,
                                ?string $subscriptionPeriodType,
                                ?string $subscriptionCancelReason,
                                ?string $subscriptionProrationMode,
                                ?string $subscriptionRenewalProduct,
                                ?string $subscriptionRenewalProductSku,
                                ?DateTime $expirationDate,
                                ?DateTime $autoResumeDate,
                                ?string $nextPurchase,
                                ?string $linkedPurchase,
                                ?string $originalPurchase)
    {
        $this->id = $id;
        $this->purchaseDate = $purchaseDate;
        $this->quantity = $quantity;
        $this->platform = $platform;
        $this->country = $country;
        $this->tags = $tags;
        $this->orderId = $orderId;
        $this->app = $app;
        $this->user = $user;
        $this->userId = $userId;
        $this->userIds = $userIds;
        $this->receipt = $receipt;
        $this->androidToken = $androidToken;
        $this->product = $product;
        $this->productSku = $productSku;
        $this->productType = $productType;
        $this->productGroupName = $productGroupName;
        $this->listing = $listing;
        $this->store = $store;
        $this->storeSegmentIndex = $storeSegmentIndex;
        $this->currency = $currency;
        $this->price = $price;
        $this->convertedCurrency = $convertedCurrency;
        $this->convertedPrice = $convertedPrice;
        $this->isSandbox = $isSandbox;
        $this->isFamilyShare = $isFamilyShare;
        $this->isPromo = $isPromo;
        $this->isRefunded = $isRefunded;
        $this->refundDate = $refundDate;
        $this->refundReason = $refundReason;
        $this->refundAmount = $refundAmount;
        $this->convertedRefundAmount = $convertedRefundAmount;
        $this->isSubscription = $isSubscription;
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Purchase
     */
    public function setId(string $id): Purchase
    {
        $this->id = $id;
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
     * @return Purchase
     */
    public function setPurchaseDate(DateTime $purchaseDate): Purchase
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return Purchase
     */
    public function setQuantity(int $quantity): Purchase
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     * @return Purchase
     */
    public function setPlatform(string $platform): Purchase
    {
        $this->platform = $platform;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Purchase
     */
    public function setCountry(string $country): Purchase
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return Purchase
     */
    public function setTags(array $tags): Purchase
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     * @return Purchase
     */
    public function setOrderId(string $orderId): Purchase
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getApp(): string
    {
        return $this->app;
    }

    /**
     * @param string $app
     * @return Purchase
     */
    public function setApp(string $app): Purchase
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return Purchase
     */
    public function setUser(string $user): Purchase
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return Purchase
     */
    public function setUserId(string $userId): Purchase
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getUserIds(): ?array
    {
        return $this->userIds;
    }

    /**
     * @param array|null $userIds
     * @return Purchase
     */
    public function setUserIds(?array $userIds): Purchase
    {
        $this->userIds = $userIds;
        return $this;
    }

    /**
     * @return string
     */
    public function getReceipt(): string
    {
        return $this->receipt;
    }

    /**
     * @param string $receipt
     * @return Purchase
     */
    public function setReceipt(string $receipt): Purchase
    {
        $this->receipt = $receipt;
        return $this;
    }

    /**
     * @return string
     */
    public function getAndroidToken(): string
    {
        return $this->androidToken;
    }

    /**
     * @param string $androidToken
     * @return Purchase
     */
    public function setAndroidToken(string $androidToken): Purchase
    {
        $this->androidToken = $androidToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getProduct(): string
    {
        return $this->product;
    }

    /**
     * @param string $product
     * @return Purchase
     */
    public function setProduct(string $product): Purchase
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductSku(): string
    {
        return $this->productSku;
    }

    /**
     * @param string $productSku
     * @return Purchase
     */
    public function setProductSku(string $productSku): Purchase
    {
        $this->productSku = $productSku;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductType(): string
    {
        return $this->productType;
    }

    /**
     * @param string $productType
     * @return Purchase
     */
    public function setProductType(string $productType): Purchase
    {
        $this->productType = $productType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductGroupName(): ?string
    {
        return $this->productGroupName;
    }

    /**
     * @param string|null $productGroupName
     * @return Purchase
     */
    public function setProductGroupName(?string $productGroupName): Purchase
    {
        $this->productGroupName = $productGroupName;
        return $this;
    }

    /**
     * @return string
     */
    public function getListing(): string
    {
        return $this->listing;
    }

    /**
     * @param string $listing
     * @return Purchase
     */
    public function setListing(string $listing): Purchase
    {
        $this->listing = $listing;
        return $this;
    }

    /**
     * @return string
     */
    public function getStore(): string
    {
        return $this->store;
    }

    /**
     * @param string $store
     * @return Purchase
     */
    public function setStore(string $store): Purchase
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @return int
     */
    public function getStoreSegmentIndex(): int
    {
        return $this->storeSegmentIndex;
    }

    /**
     * @param int $storeSegmentIndex
     * @return Purchase
     */
    public function setStoreSegmentIndex(int $storeSegmentIndex): Purchase
    {
        $this->storeSegmentIndex = $storeSegmentIndex;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Purchase
     */
    public function setCurrency(string $currency): Purchase
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Purchase
     */
    public function setPrice(float $price): Purchase
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getConvertedCurrency(): string
    {
        return $this->convertedCurrency;
    }

    /**
     * @param string $convertedCurrency
     * @return Purchase
     */
    public function setConvertedCurrency(string $convertedCurrency): Purchase
    {
        $this->convertedCurrency = $convertedCurrency;
        return $this;
    }

    /**
     * @return float
     */
    public function getConvertedPrice(): float
    {
        return $this->convertedPrice;
    }

    /**
     * @param float $convertedPrice
     * @return Purchase
     */
    public function setConvertedPrice(float $convertedPrice): Purchase
    {
        $this->convertedPrice = $convertedPrice;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSandbox(): bool
    {
        return $this->isSandbox;
    }

    /**
     * @param bool $isSandbox
     * @return Purchase
     */
    public function setIsSandbox(bool $isSandbox): Purchase
    {
        $this->isSandbox = $isSandbox;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFamilyShare(): bool
    {
        return $this->isFamilyShare;
    }

    /**
     * @param bool $isFamilyShare
     * @return Purchase
     */
    public function setIsFamilyShare(bool $isFamilyShare): Purchase
    {
        $this->isFamilyShare = $isFamilyShare;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPromo(): bool
    {
        return $this->isPromo;
    }

    /**
     * @param bool $isPromo
     * @return Purchase
     */
    public function setIsPromo(bool $isPromo): Purchase
    {
        $this->isPromo = $isPromo;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRefunded(): bool
    {
        return $this->isRefunded;
    }

    /**
     * @param bool $isRefunded
     * @return Purchase
     */
    public function setIsRefunded(bool $isRefunded): Purchase
    {
        $this->isRefunded = $isRefunded;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getRefundDate(): ?DateTime
    {
        return $this->refundDate;
    }

    /**
     * @param DateTime|null $refundDate
     * @return Purchase
     */
    public function setRefundDate(?DateTime $refundDate): Purchase
    {
        $this->refundDate = $refundDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRefundReason(): ?string
    {
        return $this->refundReason;
    }

    /**
     * @param string|null $refundReason
     * @return Purchase
     */
    public function setRefundReason(?string $refundReason): Purchase
    {
        $this->refundReason = $refundReason;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getRefundAmount(): ?float
    {
        return $this->refundAmount;
    }

    /**
     * @param float|null $refundAmount
     * @return Purchase
     */
    public function setRefundAmount(?float $refundAmount): Purchase
    {
        $this->refundAmount = $refundAmount;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getConvertedRefundAmount(): ?float
    {
        return $this->convertedRefundAmount;
    }

    /**
     * @param float|null $convertedRefundAmount
     * @return Purchase
     */
    public function setConvertedRefundAmount(?float $convertedRefundAmount): Purchase
    {
        $this->convertedRefundAmount = $convertedRefundAmount;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSubscription(): bool
    {
        return $this->isSubscription;
    }

    /**
     * @param bool $isSubscription
     * @return Purchase
     */
    public function setIsSubscription(bool $isSubscription): Purchase
    {
        $this->isSubscription = $isSubscription;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsSubscriptionActive(): ?bool
    {
        return $this->isSubscriptionActive;
    }

    /**
     * @param bool|null $isSubscriptionActive
     * @return Purchase
     */
    public function setIsSubscriptionActive(?bool $isSubscriptionActive): Purchase
    {
        $this->isSubscriptionActive = $isSubscriptionActive;
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
     * @return Purchase
     */
    public function setIsSubscriptionRenewable(?bool $isSubscriptionRenewable): Purchase
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
     * @return Purchase
     */
    public function setIsSubscriptionRetryPeriod(?bool $isSubscriptionRetryPeriod): Purchase
    {
        $this->isSubscriptionRetryPeriod = $isSubscriptionRetryPeriod;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsSubscriptionGracePeriod(): ?bool
    {
        return $this->isSubscriptionGracePeriod;
    }

    /**
     * @param bool|null $isSubscriptionGracePeriod
     * @return Purchase
     */
    public function setIsSubscriptionGracePeriod(?bool $isSubscriptionGracePeriod): Purchase
    {
        $this->isSubscriptionGracePeriod = $isSubscriptionGracePeriod;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsTrialConversion(): ?bool
    {
        return $this->isTrialConversion;
    }

    /**
     * @param bool|null $isTrialConversion
     * @return Purchase
     */
    public function setIsTrialConversion(?bool $isTrialConversion): Purchase
    {
        $this->isTrialConversion = $isTrialConversion;
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
     * @return Purchase
     */
    public function setSubscriptionState(?string $subscriptionState): Purchase
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
     * @return Purchase
     */
    public function setSubscriptionPeriodType(?string $subscriptionPeriodType): Purchase
    {
        $this->subscriptionPeriodType = $subscriptionPeriodType;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscriptionCancelReason(): ?string
    {
        return $this->subscriptionCancelReason;
    }

    /**
     * @param string $subscriptionCancelReason
     * @return Purchase
     */
    public function setSubscriptionCancelReason(?string $subscriptionCancelReason): Purchase
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
     * @return Purchase
     */
    public function setSubscriptionProrationMode(?string $subscriptionProrationMode): Purchase
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
     * @return Purchase
     */
    public function setSubscriptionRenewalProduct(?string $subscriptionRenewalProduct): Purchase
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
     * @return Purchase
     */
    public function setSubscriptionRenewalProductSku(?string $subscriptionRenewalProductSku): Purchase
    {
        $this->subscriptionRenewalProductSku = $subscriptionRenewalProductSku;
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
     * @return Purchase
     */
    public function setExpirationDate(?DateTime $expirationDate): Purchase
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
     * @return Purchase
     */
    public function setAutoResumeDate(?DateTime $autoResumeDate): Purchase
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
     * @return Purchase
     */
    public function setNextPurchase(?string $nextPurchase): Purchase
    {
        $this->nextPurchase = $nextPurchase;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLinkedPurchase(): ?string
    {
        return $this->linkedPurchase;
    }

    /**
     * @param string|null $linkedPurchase
     * @return Purchase
     */
    public function setLinkedPurchase(?string $linkedPurchase): Purchase
    {
        $this->linkedPurchase = $linkedPurchase;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOriginalPurchase(): ?string
    {
        return $this->originalPurchase;
    }

    /**
     * @param string|null $originalPurchase
     * @return Purchase
     */
    public function setOriginalPurchase(?string $originalPurchase): Purchase
    {
        $this->originalPurchase = $originalPurchase;
        return $this;
    }
}