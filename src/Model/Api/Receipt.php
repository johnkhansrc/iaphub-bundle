<?php

namespace Johnkhansrc\IaphubBundle\Model\Api;

use DateTime;

class Receipt
{
    /**
     * Date of creation.
     */
    private DateTime $createdDate;
    /**
     * How many times the receipt has been processed.
     */
    private int $processCount;
    /**
     * Last date the receipt has been processed.
     */
    private DateTime $processedDate;
    /**
     * Next date the receipt will be refreshed.
     */
    private DateTime $refreshDate;
    /**
     * User id.
     */
    private string $user;
    /**
     * Platform.
     * @var string("ios", "android")
     */
    private string $platform;
    /**
     * Receipt status.
     * @var string("new", "processed", "failed")
     */
    private string $status;
    /**
     * Receipt token.
     */
    private string $token;
    /**
     * Receipt sku (provided during the purchase).
     */
    private string $sku;

    public function __construct(DateTime $createdDate,
                                int $processCount,
                                DateTime $processedDate,
                                DateTime $refreshDate,
                                string $user,
                                string $platform,
                                string $status,
                                string $token,
                                string $sku)
    {
        $this->createdDate = $createdDate;
        $this->processCount = $processCount;
        $this->processedDate = $processedDate;
        $this->refreshDate = $refreshDate;
        $this->user = $user;
        $this->platform = $platform;
        $this->status = $status;
        $this->token = $token;
        $this->sku = $sku;
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
     * @return Receipt
     */
    public function setCreatedDate(DateTime $createdDate): Receipt
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getProcessCount(): int
    {
        return $this->processCount;
    }

    /**
     * @param int $processCount
     * @return Receipt
     */
    public function setProcessCount(int $processCount): Receipt
    {
        $this->processCount = $processCount;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getProcessedDate(): DateTime
    {
        return $this->processedDate;
    }

    /**
     * @param DateTime $processedDate
     * @return Receipt
     */
    public function setProcessedDate(DateTime $processedDate): Receipt
    {
        $this->processedDate = $processedDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getRefreshDate(): DateTime
    {
        return $this->refreshDate;
    }

    /**
     * @param DateTime $refreshDate
     * @return Receipt
     */
    public function setRefreshDate(DateTime $refreshDate): Receipt
    {
        $this->refreshDate = $refreshDate;
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
     * @return Receipt
     */
    public function setUser(string $user): Receipt
    {
        $this->user = $user;
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
     * @return Receipt
     */
    public function setPlatform(string $platform): Receipt
    {
        $this->platform = $platform;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Receipt
     */
    public function setStatus(string $status): Receipt
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Receipt
     */
    public function setToken(string $token): Receipt
    {
        $this->token = $token;
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
     * @return Receipt
     */
    public function setSku(string $sku): Receipt
    {
        $this->sku = $sku;
        return $this;
    }
}