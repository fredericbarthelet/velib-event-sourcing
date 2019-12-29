<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     messenger=true,
 *     collectionOperations={
 *         "post"
 *     },
 *     itemOperations={}
 * )
 */
final class Rent
{
    /**
     * @Assert\NotNull()
     */
    private $bikeId;

    /**
     * @Assert\NotNull()
     */
    private $stationId;

    public function getBikeId(): ?int
    {
        return $this->bikeId;
    }

    public function setBikeId(int $bikeId): self
    {
        $this->bikeId = $bikeId;

        return $this;
    }

    public function getStationId(): ?int
    {
        return $this->stationId;
    }

    public function setStationId(int $stationId): self
    {
        $this->stationId = $stationId;

        return $this;
    }


}
