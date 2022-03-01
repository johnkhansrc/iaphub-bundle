<?php

namespace Johnkhansrc\IaphubBundle\Controller;

use Exception;

use Johnkhansrc\IaphubBundle\Event\IaphubPurchaseEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubRefundEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionCancelEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionExpireEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionGracePeriodExpireEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionPauseDisabledEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionPauseEnabledEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionPauseEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionProductChangeEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionRenewalEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionRenewalRetryEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionReplaceEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubSubscriptionUnCancelEvent;
use Johnkhansrc\IaphubBundle\Event\IaphubUserIdUpdateEvent;
use Johnkhansrc\IaphubBundle\Exception\IaphubUnsuportedWebhookException;
use Johnkhansrc\IaphubBundle\Factory\WebhookFactory;
use Johnkhansrc\IaphubBundle\Service\IaphubWebhookRequestValidatorService;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IaphubWebhookEntrypointController extends AbstractController
{
    private WebhookFactory $webhookFactory;
    private ?EventDispatcherInterface $eventDispatcher;
    private IaphubWebhookRequestValidatorService $requestValidator;

    public function __construct(
        WebhookFactory $webhookFactory,
        IaphubWebhookRequestValidatorService $requestValidator,
        EventDispatcherInterface $eventDispatcher = null
    )
    {
        $this->webhookFactory = $webhookFactory;
        $this->requestValidator = $requestValidator;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @throws JsonException
     * @throws IaphubUnsuportedWebhookException
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        if (!$this->requestValidator->isValidHeader($request)) {
            return $this->json([], Response::HTTP_UNAUTHORIZED);
        }

        if (!$request->getContent()) {
            // When add webhook url on Iaphub configuration, Iaphub should verify URL.
            return $this->json([]);
        }

        $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $webhook = $this->webhookFactory::build($payload);

        switch ($webhook->getType()) {
            case 'purchase':
                $event = new IaphubPurchaseEvent($webhook);
                break;
            case 'refund':
                $event = new IaphubRefundEvent($webhook);
                break;
            case 'user_id_update':
                $event = new IaphubUserIdUpdateEvent($webhook);
                break;
            case 'subscription_renewal':
                $event = new IaphubSubscriptionRenewalEvent($webhook);
                break;
            case 'subscription_renewal_retry':
                $event = new IaphubSubscriptionRenewalRetryEvent($webhook);
                break;
            case 'subscription_grace_period_expire':
                $event = new IaphubSubscriptionGracePeriodExpireEvent($webhook);
                break;
            case 'subscription_product_change':
                $event = new IaphubSubscriptionProductChangeEvent($webhook);
                break;
            case 'subscription_replace':
                $event = new IaphubSubscriptionReplaceEvent($webhook);
                break;
            case 'subscription_cancel':
                $event = new IaphubSubscriptionCancelEvent($webhook);
                break;
            case 'subscription_uncancel':
                $event = new IaphubSubscriptionUnCancelEvent($webhook);
                break;
            case 'subscription_expire':
                $event = new IaphubSubscriptionExpireEvent($webhook);
                break;
            case 'subscription_pause':
                $event = new IaphubSubscriptionPauseEvent($webhook);
                break;
            case 'subscription_pause_enabled':
                $event = new IaphubSubscriptionPauseEnabledEvent($webhook);
                break;
            case 'subscription_pause_disabled':
                $event = new IaphubSubscriptionPauseDisabledEvent($webhook);
                break;
            default:
                throw new IaphubUnsuportedWebhookException($webhook->getType());
        }

        if ($this->eventDispatcher) {
            $this->eventDispatcher->dispatch($event::NAME, $event);
        }

        return $this->json([]);
    }
}