<?php

namespace Johnkhansrc\IaphubBundle\Model\Api;

class PostUserReceiptResponse
{
    /**
     * Status of the receipt.
     *     processed: The receipt has been processed successfully.
     *     processing: The receipt is currently processing.
     *     deferred: The receipt is deferred, pending purchase detected, its final status is pending external action.
     *     failed: The receipt processing has failed.
     *     invalid: The receipt is invalid.
     *     stale: The receipt is stale, no purchase still valid were found.
     * @var string("processed", "processing", "deferred", "failed", "invalid", "stale")
     */
    private string $status;
    /**
     * The new transactions processed in the receipt.
     *
     * @var Transaction[]
     */
    private array $newTransactions;
    /**
     * The old transactions in the receipt
     *   (Already processed or expired subscriptions, limited to the latest transaction of an sku).
     *
     * @var Transaction[]
     */
    private array $oldTransactions;

    /**
     * @param Transaction[] $newTransactions
     * @param Transaction[] $oldTransactions
     */
    public function __construct(string $status, array $newTransactions, array $oldTransactions)
    {
        $this->status = $status;
        $this->newTransactions = $newTransactions;
        $this->oldTransactions = $oldTransactions;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): PostUserReceiptResponse
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Transaction[]
     */
    public function getNewTransactions(): array
    {
        return $this->newTransactions;
    }

    /**
     * @param Transaction[] $newTransactions
     */
    public function setNewTransactions(array $newTransactions): PostUserReceiptResponse
    {
        $this->newTransactions = $newTransactions;
        return $this;
    }

    /**
     * @return Transaction[]
     */
    public function getOldTransactions(): array
    {
        return $this->oldTransactions;
    }

    /**
     * @param Transaction[] $oldTransactions
     */
    public function setOldTransactions(array $oldTransactions): PostUserReceiptResponse
    {
        $this->oldTransactions = $oldTransactions;
        return $this;
    }
}