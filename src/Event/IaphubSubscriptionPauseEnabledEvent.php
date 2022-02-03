<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionPauseEnabledEvent extends IaphubWebhookEvent
{
    /**
     * A subscription pause has been enabled (Android only).
     * The pause isn't active yet, it will occur on the subscription expiration date and
     *   you will receive a subscription_pause webhook.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionPauseEnabledEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_pause_enabled';
}
