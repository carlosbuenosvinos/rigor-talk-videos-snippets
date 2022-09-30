<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\Anemic;

interface OrderRepository
{
    public function ofId($orderId): ?Order;
}