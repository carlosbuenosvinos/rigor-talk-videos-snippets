<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\Anemic;

use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderDoesNotExistException;
use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderId;
use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderStatus;
use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\PayOrderCommand;
use Exception;

class PayOrderCommandHandler
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly PaymentProcessor $paymentProcessor
    )
    {
    }

    /**
     * @throws OrderDoesNotExistException
     */
    public function __invoke(PayOrderCommand $command): void
    {
        $orderId = OrderId::fromString($command->orderId);
        $order = $this->tryToFindOrder($orderId);
        $this->tryToPayAnOrder($order);
    }

    /**
     * @throws OrderDoesNotExistException
     */
    public function tryToFindOrder($orderId): Order
    {
        $order = $this->orderRepository->ofId($orderId);
        if (null === $order) {
            throw OrderDoesNotExistException::fromOrderId($orderId);
        }

        return $order;
    }

    /**
     * @param Order $order
     * @return void
     */
    public function tryToPayAnOrder(Order $order): void
    {
        try {
            $this->paymentProcessor->pay($order);
            $order->setStatus(OrderStatus::PAID);
        // } catch (OrderPaymentUnsuccessfulException $exception) {
        } catch (Exception $exception) {
            // ...
        }
    }
}