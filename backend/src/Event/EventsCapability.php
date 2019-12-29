<?php

declare(strict_types=1);

namespace App\Event;

trait EventsCapability
{
    /**
     * @var BikeEvent[]
     */
    private $events = [];

    protected function raise(BikeEvent $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return BikeEvent[]
     */
    public function raisedEvents(): array
    {
        return $this->events;
    }
}
