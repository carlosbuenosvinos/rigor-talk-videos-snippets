<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Richest;

use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\ProductId;
use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\ProductStatus;
use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\RecordDomainEventsTrait;

class Product
{
    use RecordDomainEventsTrait;

    protected int $status = ProductStatus::ENABLED;
    protected string $id;

    protected function id(): ProductId
    {
        return ProductId::fromString($this->id);
    }
}