<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionExpireEvent extends IaphubWebhookEvent
{
    /**
     * A subscription has expired.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionExpireEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_expire';
}
