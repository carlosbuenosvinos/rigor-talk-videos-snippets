<?php

namespace Carlos\DddDoctrineSemanticEntities\Richer;

interface ProductRepository
{
    public function ofId($productId): ?Product;
}