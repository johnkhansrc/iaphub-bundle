<?php

namespace Johnkhansrc\IaphubBundle\Model\Webhook;

use DateTime;

class UserIdUpdateWebhook extends Webhook
{
    public function __construct(
        string $id,
        string $version,
        DateTime $createdDate,
        ?string $oldUserId,
        ?string $newUserId
    )
    {
        parent::__construct($id, 'user_id_update', $version, $createdDate, null, $oldUserId, $newUserId);
    }

    /**
     * @return string|null
     */
    public function getOldUserId(): ?string
    {
        return $this->oldUserId;
    }

    /**
     * @param string|null $oldUserId
     * @return Webhook
     */
    public function setOldUserId(?string $oldUserId): Webhook
    {
        $this->oldUserId = $oldUserId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNewUserId(): ?string
    {
        return $this->newUserId;
    }

    /**
     * @param string|null $newUserId
     * @return Webhook
     */
    public function setNewUserId(?string $newUserId): Webhook
    {
        $this->newUserId = $newUserId;
        return $this;
    }
}
