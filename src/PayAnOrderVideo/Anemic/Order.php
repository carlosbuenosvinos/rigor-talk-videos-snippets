<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\Anemic;

use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderId;
use Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\OrderStatus;

class Order
{
    protected string $id;
    protected int $status = OrderStatus::PENDING;

    public function setStatus(int $orderStatus): void
    {
        $this->status = $orderStatus;
    }

    protected function id(): OrderId
    {
        return OrderId::fromString($this->id);
    }
}