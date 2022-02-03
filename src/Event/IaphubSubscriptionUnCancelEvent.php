<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionUnCancelEvent extends IaphubWebhookEvent
{
    /**
     * The auto-renewal of a subscription previously cancelled is now active.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionUnCancelEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_uncancel';
}
