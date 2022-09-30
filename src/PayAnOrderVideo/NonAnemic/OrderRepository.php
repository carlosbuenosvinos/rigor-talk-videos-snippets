<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\NonAnemic;

interface OrderRepository
{
    public function ofId($orderId): ?Order;
}