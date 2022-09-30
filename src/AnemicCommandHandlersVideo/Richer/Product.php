<?php

namespace Carlos\DddDoctrineSemanticEntities\Richer;

use Carlos\DddDoctrineSemanticEntities\Common\ProductDisabled;
use Carlos\DddDoctrineSemanticEntities\Common\ProductId;
use Carlos\DddDoctrineSemanticEntities\Common\ProductStatus;
use Carlos\DddDoctrineSemanticEntities\Common\RecordDomainEventsTrait;

class Product
{
    use RecordDomainEventsTrait;

    private int $status = ProductStatus::ENABLED;
    private string $id;

    public function disable(): void
    {
        // Good approach because it makes
        // Option A: There is nothing more to do
        // $this->status = ProductStatus::DISABLED;

        // Option B: In case we do more things
        //           than changing the internal value
        //           Idempotency check (it is safe to
        //           execute twice the same disable method)
        if ($this->status === ProductStatus::DISABLED) {
            return;
        }

        $this->status = ProductStatus::DISABLED;
        // Useful if we do other things, like recording
        // a Domain Event
        $this->recordThat(ProductDisabled::fromProductId(
            $this->id())
        );

        // Option C: Maybe trigger exceptions
        //           depending on the business logic, we need
        //           to throw an exception.
        //
        // if ($this->status === ProductStatus::DISABLED) {
        //     throw ProductCannotBeDisabledException::fromReason(
        //         $this->id,
        //         'Already disabled'
        //     );
        // }
    }

    public function enable(): void
    {
        $this->status = ProductStatus::ENABLED;
    }

    private function id(): ProductId
    {
        return ProductId::fromString($this->id);
    }
}