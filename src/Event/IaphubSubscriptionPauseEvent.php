<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionPauseEvent extends IaphubWebhookEvent
{
    /**
     * A subscription has been paused (Android only).
     * You have to restrict the access to the features offered by the subscription.
     * You will receive a subscription_renewal webhook when the subscription
     *   will automatically resume at a later date (autoResumeDate property).
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionPauseEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_pause';
}
