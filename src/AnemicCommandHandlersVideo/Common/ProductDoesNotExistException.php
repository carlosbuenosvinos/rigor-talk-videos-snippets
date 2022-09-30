<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common;

class ProductDoesNotExistException extends \Exception
{
    public static function fromProductId($productId): static
    {
        return new self(
        );
    }
}