<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Richest;

interface EnabledProductRepository
{
    public function ofId($productId): ?EnabledProduct;
}