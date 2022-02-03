<?php

namespace Johnkhansrc\IaphubBundle\Tests\Model;

use Johnkhansrc\IaphubBundle\Factory\Api\GetUserApiResponseFactory;
use Johnkhansrc\IaphubBundle\Model\Api\GetUserApiResponse;
use JsonException;

class GetUserApiResponseTest extends FactoryTestCase
{
    /**
     * @throws JsonException
     */
    public function testInstantiateGetUserApiResponse(): void
    {
//        self::assertTrue(true);
        $this->mockName = 'getUserApiResponse';

        $webhook = GetUserApiResponseFactory::build($this->decode(true));

        self::assertInstanceOf(GetUserApiResponse::class, $webhook);
    }
}