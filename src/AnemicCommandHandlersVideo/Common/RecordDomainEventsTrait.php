<?php

namespace Carlos\DddDoctrineSemanticEntities\AnemicCommandHandlersVideo\Common;

trait RecordDomainEventsTrait
{
    protected array $events = [];

    public function events(): array
    {
        return $this->events;
    }

    protected function recordThat($event): void
    {
        $this->events[] = $event;
    }
}