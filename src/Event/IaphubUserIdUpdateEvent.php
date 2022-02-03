<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubUserIdUpdateEvent extends IaphubWebhookEvent
{
    /**
     * This event is triggered when IAPHUB transfers the purchases of a user to a different user id.
     * It can happen when:
     *   - A user restore its purchases with a different user id
     *   - A user replace an active subscription with a different user id
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubUserIdUpdateEvent")
     */
    public const NAME = 'iaphub.webhook.user_id_update';
}
