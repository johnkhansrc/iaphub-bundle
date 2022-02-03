<?php

namespace Johnkhansrc\IaphubBundle\Model\Webhook;

use DateTime;

class PurchaseWebhook extends Webhook
{
    public function __construct(
        string $id,
        string $type,
        string $version,
        DateTime $createdDate,
        ?WebhookData $data
    )
    {
        parent::__construct($id, $type, $version, $createdDate, $data, null, null);
    }

    /**
     * @return WebhookData|null
     */
    public function getData(): ?WebhookData
    {
        return $this->data;
    }

    /**
     * @param WebhookData|null $data
     * @return Webhook
     */
    public function setData(?WebhookData $data): Webhook
    {
        $this->data = $data;
        return $this;
    }
}
