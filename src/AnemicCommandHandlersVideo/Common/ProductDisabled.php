<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common;

class ProductDisabled
{
    public readonly \DateTimeInterface $occurredOn;

    public function __construct(
        public readonly string $productId,
    )
    {

    }

    public static function fromProductId(ProductId $id): self
    {
        return new self($id->value());
    }
}