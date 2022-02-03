<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionCancelEvent extends IaphubWebhookEvent
{
    /**
     * A subscription auto-renewal has been cancelled (but is still active).
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionCancelEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_cancel';
}
