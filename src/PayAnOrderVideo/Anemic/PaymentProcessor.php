<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\Anemic;

interface PaymentProcessor
{
    public function pay(Order $order);
}