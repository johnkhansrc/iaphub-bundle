<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionGracePeriodExpireEvent extends IaphubWebhookEvent
{
    /**
     * A subscription grace period has ended.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionGracePeriodExpireEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_grace_period_expire';
}
