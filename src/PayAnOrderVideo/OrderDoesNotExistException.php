<?php

namespace Carlos\DddDoctrineSemanticEntities\PayAnOrderVideo;

class OrderDoesNotExistException extends \Exception
{
    public static function fromOrderId(OrderId $orderId): static
    {
        return new self(
        );
    }
}