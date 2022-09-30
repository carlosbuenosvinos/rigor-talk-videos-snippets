<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common;

class ProductCannotBeDisabledException extends \Exception
{
    public static function fromReason(string $id, string $string): static
    {
        return new self(

        );
    }
}