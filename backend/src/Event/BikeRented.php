<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Bike;
use App\Entity\Station;
use App\Entity\User;

final class BikeRented implements BikeEvent
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

    /**
     * @var User
     */
    private $user;

    public function __construct(\DateTimeInterface $eventTime, Station $station, Bike $bike, User $user)
    {
        $this->eventTime = $eventTime;
        $this->station = $station;
        $this->bike = $bike;
        $this->user = $user;
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

    public function getUser(): User
    {
        return $this->user;
    }
}
