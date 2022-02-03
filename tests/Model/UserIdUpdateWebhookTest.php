<?php

namespace Johnkhansrc\IaphubBundle\Tests\Model;

use Johnkhansrc\IaphubBundle\Factory\WebhookFactory;
use Johnkhansrc\IaphubBundle\Model\Webhook\UserIdUpdateWebhook;
use JsonException;

class UserIdUpdateWebhookTest extends FactoryTestCase
{
    /**
     * @throws JsonException
     */
    public function testInstantiateUserIdUpdateWebhook(): void
    {
        $this->mockName = 'userIdUpdateMocks';

        $webhook = WebhookFactory::build($this->decode());

        self::assertInstanceOf(UserIdUpdateWebhook::class, $webhook);
    }
}
