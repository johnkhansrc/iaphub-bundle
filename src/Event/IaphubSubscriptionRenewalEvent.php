<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionRenewalEvent extends IaphubWebhookEvent
{
    /**
     * A subscription has been renewed.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionRenewalEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_renewal';
}
