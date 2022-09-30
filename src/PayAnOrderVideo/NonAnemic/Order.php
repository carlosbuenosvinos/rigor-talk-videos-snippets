<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\NonAnemic;

use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderId;
use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderStatus;

class Order
{
    protected string $id;
    protected int $status = OrderStatus::PENDING;

    public function pay(PaymentProcessor $paymentProcessor): void
    {
        try {
            $paymentProcessor->pay($this);
            $this->status = OrderStatus::PAID;
        // } catch (OrderPaymentUnsuccessfulException $exception) {
        } catch (\Exception $exception) {
            // ...
        }
    }

    protected function id(): OrderId
    {
        return OrderId::fromString($this->id);
    }
}