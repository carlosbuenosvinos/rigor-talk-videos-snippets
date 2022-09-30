<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\NonAnemic;

use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderDoesNotExistException;
use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderId;
use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\PayOrderCommand;

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
        $this->tryToPayOrder($order);
    }

    /**
     * @throws OrderDoesNotExistException
     */
    public function tryToFindOrder($orderId): Order
    {
        $product = $this->orderRepository->ofId($orderId);
        if (null === $product) {
            throw OrderDoesNotExistException::fromOrderId($orderId);
        }

        return $product;
    }

    private function tryToPayOrder(Order $order): void
    {
        try {
            $order->pay($this->paymentProcessor);
        // } catch (OrderPaymentUnsuccessfulException $exception) {
        } catch (\Exception $exception) {


        }
    }
}
