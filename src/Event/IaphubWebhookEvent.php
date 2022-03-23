<?php

namespace Johnkhansrc\IaphubBundle\Event;

use Johnkhansrc\IaphubBundle\Model\Webhook\Webhook;
use Symfony\Contracts\EventDispatcher\Event;

//use Symfony\Component\EventDispatcher\Event;

class IaphubWebhookEvent extends Event
{
    protected Webhook $webhook;

    public function __construct(Webhook $webhook)
    {
        $this->webhook = $webhook;
    }

    public function getWebhook(): Webhook
    {
        return $this->webhook;
    }
}
