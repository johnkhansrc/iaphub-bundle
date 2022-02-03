<?php

namespace Johnkhansrc\IaphubBundle\Event;

class IaphubSubscriptionRenewalRetryEvent extends IaphubWebhookEvent
{
    /**
     * A subscription renewal has failed but will be retried.
     * More informations: https://www.iaphub.com/docs/getting-started/manage-subscription-states#subscription-renewal-retry
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionRenewalRetryEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_renewal_retry';
}
