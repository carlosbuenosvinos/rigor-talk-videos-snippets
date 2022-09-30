<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Anemic;

interface ProductRepository
{
    public function ofId($productId): ?Product;
}