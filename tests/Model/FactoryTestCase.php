<?php

namespace Johnkhansrc\IaphubBundle\Tests\Model;

use JsonException;
use PHPUnit\Framework\TestCase;

class FactoryTestCase extends TestCase
{
    public const PARTIAL_MOCKS_PATH = __DIR__ . '/../Mocks/webhooksPayloads/%s.json';
    protected string $mockName;

    protected function mockPath(): string
    {
        return sprintf(self::PARTIAL_MOCKS_PATH, $this->mockName);
    }

    protected function apiMockPath(): string
    {
        return str_replace('webhooksPayloads', 'apiPayloads', sprintf(self::PARTIAL_MOCKS_PATH, $this->mockName));
    }

    /**
     * @throws JsonException
     * @return array<string, mixed>
     */
    protected function decode(bool $api = false): array
    {
        if ($api) {
            $path = $this->apiMockPath();
        } else {
            $path = $this->mockPath();
        }
        /** @var string $mock */
        $mock = file_get_contents($path);
        return json_decode($mock, true, 512, JSON_THROW_ON_ERROR);
    }
}
