<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Event\BikeEvent;
use App\Event\BikeRented;
use App\Event\BikeReturned;
use App\Event\EventsCapability;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\BikeRepository")
 */
class Bike
{
    use EventsCapability;

    public const TYPE_MECHANIC = 1;
    public const TYPE_ELECTRIC = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type = self::TYPE_MECHANIC;

    /**
     * @var bool
     */
    private $inUse = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isInUse(): bool
    {
        return $this->inUse;
    }

    public function rent(Station $station, User $user): self
    {
        if ($this->inUse) {
            throw new \Exception('Bike already rented');
        }

        $bikeRentedEvent = new BikeRented(
            new \DateTime(),
            $station,
            $this,
            $user
        );

        $this->raise($bikeRentedEvent);

        return $this;
    }

    public function return(Station $station): self
    {
        $bikeReturnedEvent = new BikeReturned(
            new \DateTime(),
            $station,
            $this
        );

        $this->raise($bikeReturnedEvent);

        return $this;
    }

    public function apply(BikeEvent $event): void
    {
        if ($event instanceof BikeRented) {
            $this->inUse = true;
        }

        if ($event instanceof BikeReturned) {
            $this->isUse = false;
        }
    }

    /**
     * @param BikeEvent[] $events
     */
    public function fromEvents(array $events): self
    {
        foreach ($events as $event) {
            $this->apply($event);
        }

        return $this;
    }
}
