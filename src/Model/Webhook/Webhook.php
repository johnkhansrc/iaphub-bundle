<?php

namespace Johnkhansrc\IaphubBundle\Model\Webhook;

use DateTime;

abstract class Webhook
{
    /**
     * Id of the webhook event
     */
    protected string $id;
    /**
     * The type of event, it can be one of the following:
     *     purchase: A product has been purchased (triggered for subscriptions as well if it isn't a renewal).
     *     refund: A purchase has been refunded.
     *     user_id_update: A user id has been updated.
     *     subscription_renewal: A subscription has been renewed.
     *     subscription_renewal_retry: A subscription renewal has failed but will be retried.
     *     subscription_grace_period_expire: A subscription grace period has ended.
     *     subscription_product_change: A subscription product has been changed (will be replaced at the next renewal date).
     *     subscription_replace: A subscription has been replaced by a new subscription with a different product.
     *     subscription_cancel: A subscription auto-renewal has been cancelled (but is still active).
     *     subscription_uncancel: The auto-renewal of a subscription previously cancelled is now active.
     *     subscription_expire: A subscription has expired.
     *     subscription_pause: A subscription has been paused (Android only).
     *     subscription_pause_enabled: A subscription pause has been enabled (Android only).
     *     subscription_pause_disabled: A subscription pause has been disabled (Android only).
     * @var string(
     *     "purchase",
     *     "refund",
     *     "user_id_update",
     *     "subscription_renewal",
     *     "subscription_renewal_retry",
     *     "subscription_grace_period_expire",
     *     "subscription_product_change",
     *     "subscription_replace",
     *     "subscription_cancel",
     *     "subscription_uncancel",
     *     "subscription_expire",
     *     "subscription_pause",
     *     "subscription_pause_enabled",
     *     "subscription_pause_disabled")
     */
    protected string $type;
    /**
     * Version of the webhook format, using semantic versioning.
     */
    protected string $version;
    protected DateTime $createdDate;
    protected ?WebhookData $data = null;
    protected ?string $oldUserId;
    protected ?string $newUserId;

    public function __construct(
        string $id,
        string $type,
        string $version,
        DateTime $createdDate,
        ?WebhookData $data,
        ?string $oldUserId,
        ?string $newUserId
    )
    {
        $this->id = $id;
        $this->type = $type;
        $this->version = $version;
        $this->createdDate = $createdDate;
        $this->data = $data;
        $this->oldUserId = $oldUserId;
        $this->newUserId = $newUserId;
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
     * @return Webhook
     */
    public function setId(string $id): Webhook
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
     * @return Webhook
     */
    public function setType(string $type): Webhook
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return Webhook
     */
    public function setVersion(string $version): Webhook
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedDate(): DateTime
    {
        return $this->createdDate;
    }

    /**
     * @param DateTime $createdDate
     * @return Webhook
     */
    public function setCreatedDate(DateTime $createdDate): Webhook
    {
        $this->createdDate = $createdDate;
        return $this;
    }
}
