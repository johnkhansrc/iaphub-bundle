<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionReplaceEvent extends IaphubWebhookEvent
{
    /**
     * A subscription has been replaced by a new subscription.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionReplaceEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_replace';
}
