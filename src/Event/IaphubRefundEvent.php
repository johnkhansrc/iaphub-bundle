<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubRefundEvent extends IaphubWebhookEvent
{
    /**
     * A purchase has been refunded.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubRefundEvent")
     */
    public const NAME = 'iaphub.webhook.refund';
}
