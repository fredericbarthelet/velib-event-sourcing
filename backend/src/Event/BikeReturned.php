<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Bike;
use App\Entity\Station;

final class BikeReturned implements BikeEvent
{
    /**
     * @var \DateTimeInterface
     */
    private $eventTime;

    /**
     * @var Station
     */
    private $station;

    /**
     * @var Bike
     */
    private $bike;

    public function __construct(\DateTimeInterface $eventTime, Station $station, Bike $bike)
    {
        $this->eventTime = $eventTime;
        $this->station = $station;
        $this->bike = $bike;
    }

    public function getEventTime(): \DateTimeInterface
    {
        return $this->eventTime;
    }

    public function getStation(): Station
    {
        return $this->station;
    }

    public function getBike(): Bike
    {
        return $this->bike;
    }
}
