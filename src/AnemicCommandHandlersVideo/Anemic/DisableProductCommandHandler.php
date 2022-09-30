<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Anemic;

use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\DisableProductCommand;
use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\ProductDoesNotExistException;
use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\ProductId;
use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\ProductStatus;

class DisableProductCommandHandler
{
    public function __construct(
        private readonly ProductRepository $productRepository
    )
    {
    }

    /**
     * @throws ProductDoesNotExistException
     */
    public function __invoke(DisableProductCommand $command): void
    {
        // First thing, we move basic types into value objects
        $productId = ProductId::fromString($command->productId);

        // Let's find the product
        $product = $this->tryToFindProduct($productId);

        // It works, but not the best approach
        if ($product->status() === ProductStatus::ENABLED) {
            $product->disable();
        }

        /*
            1. Command Handlers don't manage business logic
            2. Command Handlers delegate as much as possible into
               Aggregates, Domain Services, and other "Domain" building blocks.
            3. A typical Command Handler responsibility is to find
               the corresponding Aggregates to act on and delegate
               the operation
            4. Having the business logic in the Command Handler makes
               our Domain anemic, with Aggregates that are mainly
               POPO (Plain Old PHP Objects) with getters and setters
        */
    }

    /**
     * @throws ProductDoesNotExistException
     */
    public function tryToFindProduct($productId): Product
    {
        $product = $this->productRepository->ofId($productId);
        if (null === $product) {
            throw ProductDoesNotExistException::fromProductId($productId);
        }

        return $product;
    }
}