<?php

namespace Johnkhansrc\IaphubBundle\Tests;

use Johnkhansrc\IaphubBundle\Exception\IaphubBundleBadQueryStringException;
use Johnkhansrc\IaphubBundle\Exception\IaphubBundleBadQueryStringValueException;
use Johnkhansrc\IaphubBundle\Service\IaphubHttpClientValidationService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IaphubHttpClientValidationServiceTest extends TestCase
{
    private JohnkhansrcIaphubTestingKernel $kernel;
    private ContainerInterface $container;
    private IaphubHttpClientValidationService $validatorService;

    public function setUp(): void
    {
        $kernel = new JohnkhansrcIaphubTestingKernel([
            'apikey' => 'foo',
            'webhook_auth_token' => 'bar',
        ]);
        $kernel->boot();
        $container = $kernel->getContainer();

        /** @var IaphubHttpClientValidationService $validatorService */
        $validatorService = $container->get('johnkhansrc_iaphub.iaphub_http_client_validation_service');

        $this->kernel = $kernel;
        $this->container = $container;
        $this->validatorService = $validatorService;

        parent::setUp();
    }

    public function testWithoutNamespace()
    {
        self::assertEquals('testWithoutNamespace', $this->validatorService::withoutNamespace(__METHOD__));
    }

    public function testValidateBodyParameters(): void
    {
        $body = [
            'environment' => 'staging',
            'platform' => 'android',
            'token' => 'xxxxxxxxxx',
            'sku' => 'xxx_sku_xxx',
            'upsert' => true,
        ];

        $exception = null;
        try {

            $this->validatorService->validateBodyParameters($body, 'postUserReceipt', 'foo.bar.com');
        } catch (\Exception $err) {
            $exception = $err;
        } finally {
            self::assertNull($exception);
        }
    }

    public function testInvalidateBodyParameters(): void
    {
        $body = [
            'foo' => 'staging',
            'platform' => 'android',
            'token' => 'xxxxxxxxxx',
            'sku' => 'xxx_sku_xxx',
            'upsert' => true,
        ];

        $exception = null;
        try {

            $this->validatorService->validateBodyParameters($body, 'postUserReceipt', 'foo.bar.com');
        } catch (\Exception $err) {
            $exception = $err;
        } finally {
            self::assertInstanceOf(IaphubBundleBadQueryStringException::class, $exception);
            $exceptedMessage = "Cant call foo.bar.com with query parameter 'postUserReceipt', accepted parameters: environment, platform, token, sku, context, prorationMode, upsert";
            self::assertEquals($exceptedMessage, $exception->getMessage());
        }
    }

    public function testInvalidateBodyParameterValues(): void
    {
        $body = [
            'environment' => 'bar',
            'platform' => 'android',
            'token' => 'xxxxxxxxxx',
            'sku' => 'xxx_sku_xxx',
            'upsert' => true,
        ];

        $exception = null;
        try {

            $this->validatorService->validateBodyParameters($body, 'postUserReceipt', 'foo.bar.com');
        } catch (\Exception $err) {
            $exception = $err;
        } finally {
            self::assertNotNull($exception);
            self::assertInstanceOf(IaphubBundleBadQueryStringValueException::class, $exception);
            $exceptedMessage = "Cant call foo.bar.com with query parameter value 'bar', accepted values: production, staging, development";
            self::assertEquals($exceptedMessage, $exception->getMessage());
        }
    }
}
