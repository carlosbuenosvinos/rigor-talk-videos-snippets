<?php

namespace Carlos\DddDoctrineSemanticEntities\Richer;

use Carlos\DddDoctrineSemanticEntities\Common\DisableProductCommand;
use Carlos\DddDoctrineSemanticEntities\Common\ProductDoesNotExistException;
use Carlos\DddDoctrineSemanticEntities\Common\ProductId;

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

        // Better option using "Tell Don't Ask"
        // @see https://martinfowler.com/bliki/TellDontAsk.html
        $product->disable();
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
