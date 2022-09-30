<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo\NonAnemic;

interface PaymentProcessor
{
    public function pay(Order $order);
}