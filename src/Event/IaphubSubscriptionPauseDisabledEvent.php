<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionPauseDisabledEvent extends IaphubWebhookEvent
{
    /**
     * A subscription pause has been disabled (Android only).
     * The subscription will renew on the expiration date.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionPauseDisabledEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_pause_disabled';
}
