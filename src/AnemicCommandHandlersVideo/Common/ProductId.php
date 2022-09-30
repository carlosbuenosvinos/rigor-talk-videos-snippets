<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common;

use Symfony\Component\Uid\Uuid;

class ProductId
{
    private function __construct(
        private readonly string $value
    )
    {
        if (!Uuid::isValid($this->value)) {
            throw new \InvalidArgumentException('No valid UUID value');
        }
    }

    public static function fromString(string $productId): static
    {
        return new self($productId);
    }

    public function value(): string
    {
        return $this->value;
    }
}