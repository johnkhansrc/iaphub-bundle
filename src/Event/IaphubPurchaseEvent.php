<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubPurchaseEvent extends IaphubWebhookEvent
{
    /**
     * A product has been purchased.
     * This event is triggered when purchasing a consumable, non-consumable or new subscription.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubPurchaseEvent")
     */
    public const NAME = 'iaphub.webhook.purchase';
}
