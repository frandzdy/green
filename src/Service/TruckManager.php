<?php

namespace App\Service;

use App\Entity\HistoryNewPlate;
use App\Entity\Truck;
use App\Enum\Service;
use App\Enum\Status;
use Doctrine\ORM\EntityManagerInterface;

class TruckManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function saveOrUpdateTruck(Truck $truck): void
    {
        $truck->setToShow(true);

        if (!$truck->getId()) {
            $this->em->persist($truck);
        }

        if (\in_array($truck->getService(), [Service::RECEPTION_LETTER, Service::GENERAL_STORE_LETTER], true)) {
            $truck->setStatus(Status::CALL);
        }

        $historyNewPlate = $this->em->getRepository(HistoryNewPlate::class)->findOneBy(['id' => $truck->getHistoryNewPlate()->getId()]);
        $truck->setHistoryNewPlate($historyNewPlate);

        $this->em->flush();
    }

    public function deleteTruck(Truck $truck): void
    {
        $this->em->remove($truck);
        $this->em->flush();
    }

    function generateDailyCode(string $uniqueIdentifier): string
    {
        $date = date('Ymd');
        $data = $uniqueIdentifier . $date;

        return substr(hash('sha256', $data), 0, 4);
    }
}
