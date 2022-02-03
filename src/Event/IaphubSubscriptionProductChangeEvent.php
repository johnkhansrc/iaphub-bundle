<?php

namespace Johnkhansrc\IaphubBundle\Event;

final class IaphubSubscriptionProductChangeEvent extends IaphubWebhookEvent
{
    /**
     * The product of the subscription has been changed, the subscription will be replaced with the new product at
     *   the next renewal date.
     *
     * The new product sku is available in the subscriptionRenewalProductSku property.
     *
     * NOTE
     * This event is only triggered on IOS, currently Android does not offer any way to detect the next product sku
     *   from the receipt when a deferred subscription replace is performed.
     * It is triggered on IOS when having a subscription downgrade or a subscription crossgrade with a different duration.
     *
     * @Event("Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionProductChangeEvent")
     */
    public const NAME = 'iaphub.webhook.subscription_product_change';
}
