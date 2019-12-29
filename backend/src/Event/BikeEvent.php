<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Bike;

interface BikeEvent
{
    public function getBike(): Bike;

    public function getEventTime(): \DateTimeInterface;
}
