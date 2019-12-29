<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Bike;
use App\Entity\Rent;
use App\Entity\Station;
use App\Entity\User;
use App\Repository\BikeRepository;
use App\Repository\StationRepository;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Security;

final class RentHandler implements MessageHandlerInterface
{
    /**
     * @var BikeRepository
     */
    private $bikeRepository;

    /**
     * @var StationRepository
     */
    private $stationRepository;

    /**
     * @var Security
     */
    private $security;

    public function __construct(BikeRepository $bikeRepository, StationRepository $stationRepository, Security $security)
    {
        $this->bikeRepository = $bikeRepository;
        $this->stationRepository = $stationRepository;
        $this->security = $security;
    }

    public function __invoke(Rent $rent)
    {
        /** @var Bike $bike */
        $bike = $this->bikeRepository->find($rent->getBikeId());
        if (!$bike) {
            throw new NotFoundHttpException('No bike with id ' . $rent->getBikeId());
        }

        /** @var Station $station */
        $station = $this->stationRepository->find($rent->getStationId());
        if (!$station) {
            throw new NotFoundHttpException('No station with id ' . $rent->getStationId());
        }

        $user = $this->security->getUser();
        if (!$user instanceof User) {
            throw new AccessDeniedHttpException('User not found');
        }

        $bike->rent($station, $user);

        return $bike->fromEvents($bike->raisedEvents());
    }
}
