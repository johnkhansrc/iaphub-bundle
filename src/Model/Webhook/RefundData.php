<?php

namespace Johnkhansrc\IaphubBundle\Model\Webhook;

use DateTime;

/**
 * Only if WebhookData::isRefunded is true.
 */
class RefundData
{
    /**
     * Date of the refund.
     */
    private DateTime $refundDate;
    /**
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
     * @var string(
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
    private string $refundReason;
    /**
     * Refund amount (using the currency of purchase).
     */
    private ?float $refundAmount;
    /**
     * Refund amount (using the converted currency).
     */
    private ?float $convertedRefundAmount;

    public function __construct(
        DateTime $refundDate,
        string $refundReason,
        ?float $refundAmount,
        ?float $convertedRefundAmount
    )
    {
        $this->refundDate = $refundDate;
        $this->refundReason = $refundReason;
        $this->refundAmount = $refundAmount;
        $this->convertedRefundAmount = $convertedRefundAmount;
    }

    /**
     * @return DateTime
     */
    public function getRefundDate(): DateTime
    {
        return $this->refundDate;
    }

    /**
     * @param DateTime $refundDate
     * @return RefundData
     */
    public function setRefundDate(DateTime $refundDate): RefundData
    {
        $this->refundDate = $refundDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefundReason(): string
    {
        return $this->refundReason;
    }

    /**
     * @param string $refundReason
     * @return RefundData
     */
    public function setRefundReason(string $refundReason): RefundData
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
     * @return RefundData
     */
    public function setRefundAmount(?float $refundAmount): RefundData
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
     * @return RefundData
     */
    public function setConvertedRefundAmount(?float $convertedRefundAmount): RefundData
    {
        $this->convertedRefundAmount = $convertedRefundAmount;
        return $this;
    }
}
