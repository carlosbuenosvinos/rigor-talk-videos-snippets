<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Anemic;

use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\ProductStatus;

class Product
{
    private int $status = ProductStatus::ENABLED;

    public function disable(): void
    {
        $this->status = ProductStatus::DISABLED;
    }

    public function enable(): void
    {
        $this->status = ProductStatus::ENABLED;
    }

    public function status(): int
    {
        return $this->status;
    }
}