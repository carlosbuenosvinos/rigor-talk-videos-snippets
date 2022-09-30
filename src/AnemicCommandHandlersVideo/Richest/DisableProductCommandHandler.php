<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Richest;

use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\DisableProductCommand;
use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\ProductDoesNotExistException;
use Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common\ProductId;

class DisableProductCommandHandler
{
    public function __construct(
        private readonly EnabledProductRepository $enabledProductRepository
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

        // Better option using "Tell Don't Ask"
        // @see https://martinfowler.com/bliki/TellDontAsk.html
        $product->disable();
    }

    /**
     * @throws ProductDoesNotExistException
     */
    public function tryToFindProduct($productId): EnabledProduct
    {
        $product = $this->enabledProductRepository->ofId($productId);
        if (null === $product) {
            throw ProductDoesNotExistException::fromProductId($productId);
        }

        return $product;
    }
}
