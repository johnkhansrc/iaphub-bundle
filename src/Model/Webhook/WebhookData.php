<?php

namespace Johnkhansrc\IaphubBundle\Model\Webhook;

use DateTime;
use Exception;
use Johnkhansrc\IaphubBundle\Exception\MissingRefunDataException;
use Johnkhansrc\IaphubBundle\Exception\MissingSubscriptionDataException;

class WebhookData
{
    /**
     * Id of the purchase.
     */
    protected string $id;
    /**
     * Date of purchase.
     */
    protected DateTime $purchaseDate;
    /**
     * Quantity.
     */
    protected int $quantity;
    /**
     * Platform.
     *     ios: Ios platform.
     *     android: Android platform.
     * @var string("ios", "android")
     */
    protected string $platform;
    /**
     * Country of the user on purchase.
     */
    protected string $country;
    /**
     * Tags of the user on purchase.
     * @var mixed[]
     */
    protected array $tags;
    /**
     * IOS/Android order id of the purchase.
     */
    protected string $orderId;
    /**
     * App id.
     */
    protected string $app;
    /**
     * User id (from IAPHUB).
     */
    protected string $user;
    /**
     * User id (you provided at login) of the user that purchased the product.
     */
    protected string $userId;
    /**
     * Receipt id.
     */
    protected ?string $receipt;
    /**
     * Android purchase token.
     */
    protected ?string $androidToken;
    /**
     * Product id.
     */
    protected string $product;
    /**
     * Product sku.
     */
    protected string $productSku;
    /**
     * Product type of the purchase.
     *     consumable: Consumable product.
     *     non_consumable: Non-consumable product.
     *     renewable_subscription: Auto-renewable subscription.
     *     subscription: Non-renewing subscription.
     * @var string("consumable", "non_consumable", "renewable_subscription", "subscription")
     */
    protected string $productType;
    /**
     * Product group name (only if the product has a group).
     */
    protected ?string $productGroup = null;
    /**
     * Listing id.
     */
    protected string $listing;
    /**
     * Store id.
     */
    protected string $store;
    /**
     * Store segment index (when a store is used for testing, 0 by default).
     */
    protected ?int $storeSegmentIndex;
    /**
     * Price currency.
     */
    protected string $currency;
    /**
     * Price amount.
     */
    protected float $price;
    /**
     * Currency configured on your app settings.
     */
    protected string $convertedCurrency;
    /**
     * Price amount converted to the currency of your app.
     */
    protected float $convertedPrice;
    /**
     * True if it is a sandbox purchase.
     */
    protected bool $isSandbox;
    /**
     * True if it is shared by a family member (iOS only).
     */
    protected ?bool $isFamilyShare;
    /**
     * True if it has been purchased from a promo code.
     */
    protected ?bool $isPromo;
    /**
     * True if the purchase has been refunded.
     */
    protected bool $isRefunded;
    /**
     * Only if isRefunded is true,
     *     provide refundDate, refundReason, refundAmount, convertedRefundAmount.
     */
    protected ?RefundData $refundData = null;
    /**
     * True if it is a subscription.
     */
    protected bool $isSubscription;
    /**
     * Only if Subscription is true,
     *     provide isSubscriptionActive, isSubscriptionRenewable, isSubscriptionRetryPeriod, isSubscriptionGracePeriod,
     *          isTrialConversion, subscriptionState, subscriptionPeriodType, subscriptionCancelReason,
     *          subscriptionProrationMode, subscriptionRenewalProduct, subscriptionRenewalProductSku, expirationDate,
     *          autoResumeDate, nextPurchase, linkedPurchase, originalPurchase.
     */
    protected ?SubscriptionData $subscriptionData = null;

    /**
     * @param mixed[] $tags
     */
    public function __construct(
        string $id,
        DateTime $purchaseDate,
        int $quantity,
        string $platform,
        string $country,
        array $tags,
        string $orderId,
        string $app,
        string $user,
        string $userId,
        ?string $receipt,
        ?string $androidToken,
        string $product,
        string $productSku,
        string $productType,
        ?string $productGroup,
        string $listing,
        string $store,
        ?int $storeSegmentIndex,
        string $currency,
        float $price,
        string $convertedCurrency,
        float $convertedPrice,
        bool $isSandbox,
        ?bool $isFamilyShare,
        ?bool $isPromo,
        bool $isRefunded,
        ?RefundData $refundData,
        bool $isSubscription,
        ?SubscriptionData $subscriptionData
    )
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
        $this->receipt = $receipt;
        $this->androidToken = $androidToken;
        $this->product = $product;
        $this->productSku = $productSku;
        $this->productType = $productType;
        $this->productGroup = $productGroup;
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
        $this->refundData = $refundData;
        $this->isSubscription = $isSubscription;
        $this->subscriptionData = $subscriptionData;
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
     * @return WebhookData
     */
    public function setId(string $id): WebhookData
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
     * @return WebhookData
     */
    public function setPurchaseDate(DateTime $purchaseDate): WebhookData
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
     * @return WebhookData
     */
    public function setQuantity(int $quantity): WebhookData
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
     * @return WebhookData
     */
    public function setPlatform(string $platform): WebhookData
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
     * @return WebhookData
     */
    public function setCountry(string $country): WebhookData
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param mixed[] $tags
     * @return WebhookData
     */
    public function setTags(array $tags): WebhookData
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
     * @return WebhookData
     */
    public function setOrderId(string $orderId): WebhookData
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
     * @return WebhookData
     */
    public function setApp(string $app): WebhookData
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
     * @return WebhookData
     */
    public function setUser(string $user): WebhookData
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
     * @return WebhookData
     */
    public function setUserId(string $userId): WebhookData
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReceipt(): ?string
    {
        return $this->receipt;
    }

    /**
     * @param null|string $receipt
     * @return WebhookData
     */
    public function setReceipt(?string $receipt): WebhookData
    {
        $this->receipt = $receipt;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAndroidToken(): ?string
    {
        return $this->androidToken;
    }

    /**
     * @param string $androidToken
     * @return WebhookData
     */
    public function setAndroidToken(?string $androidToken): WebhookData
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
     * @return WebhookData
     */
    public function setProduct(string $product): WebhookData
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
     * @return WebhookData
     */
    public function setProductSku(string $productSku): WebhookData
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
     * @return WebhookData
     */
    public function setProductType(string $productType): WebhookData
    {
        $this->productType = $productType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductGroup(): ?string
    {
        return $this->productGroup;
    }

    /**
     * @param string|null $productGroup
     * @return WebhookData
     */
    public function setProductGroup(?string $productGroup): WebhookData
    {
        $this->productGroup = $productGroup;
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
     * @return WebhookData
     */
    public function setListing(string $listing): WebhookData
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
     * @return WebhookData
     */
    public function setStore(string $store): WebhookData
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @return ?int
     */
    public function getStoreSegmentIndex(): ?int
    {
        return $this->storeSegmentIndex;
    }

    /**
     * @param null|int $storeSegmentIndex
     * @return WebhookData
     */
    public function setStoreSegmentIndex(?int $storeSegmentIndex): WebhookData
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
     * @return WebhookData
     */
    public function setCurrency(string $currency): WebhookData
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
     * @return WebhookData
     */
    public function setPrice(float $price): WebhookData
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
     * @return WebhookData
     */
    public function setConvertedCurrency(string $convertedCurrency): WebhookData
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
     * @return WebhookData
     */
    public function setConvertedPrice(float $convertedPrice): WebhookData
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
     * @return WebhookData
     */
    public function setIsSandbox(bool $isSandbox): WebhookData
    {
        $this->isSandbox = $isSandbox;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function isFamilyShare(): ?bool
    {
        return $this->isFamilyShare;
    }

    /**
     * @param null|bool $isFamilyShare
     * @return WebhookData
     */
    public function setIsFamilyShare(?bool $isFamilyShare): WebhookData
    {
        $this->isFamilyShare = $isFamilyShare;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function isPromo(): ?bool
    {
        return $this->isPromo;
    }

    /**
     * @param null|bool $isPromo
     * @return WebhookData
     */
    public function setIsPromo(?bool $isPromo): WebhookData
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
     * @return WebhookData
     */
    public function setIsRefunded(bool $isRefunded): WebhookData
    {
        $this->isRefunded = $isRefunded;
        return $this;
    }

    /**
     * @return RefundData|null
     */
    public function getRefundData(): ?RefundData
    {
        return $this->refundData;
    }

    /**
     * @param RefundData|null $refundData
     * @return WebhookData
     */
    public function setRefundData(?RefundData $refundData): WebhookData
    {
        $this->refundData = $refundData;
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
     * @return WebhookData
     */
    public function setIsSubscription(bool $isSubscription): WebhookData
    {
        $this->isSubscription = $isSubscription;
        return $this;
    }

    /**
     * @return SubscriptionData|null
     */
    public function getSubscriptionData(): ?SubscriptionData
    {
        return $this->subscriptionData;
    }

    /**
     * @param SubscriptionData|null $subscriptionData
     * @return WebhookData
     */
    public function setSubscriptionData(?SubscriptionData $subscriptionData): WebhookData
    {
        $this->subscriptionData = $subscriptionData;
        return $this;
    }
}
