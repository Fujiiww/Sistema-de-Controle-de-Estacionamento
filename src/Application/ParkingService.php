<?php

namespace App\Application\Service;

use App\Domain\Entity\Vehicle;
use App\Domain\Pricing\PricingInterface;
use App\Domain\Repository\VehicleRepositoryInterface;
use DateTime;

class ParkingService
{
    private VehicleRepositoryInterface $repo;

    private array $pricingMap;

    public function __construct(
        VehicleRepositoryInterface $repo,
        array $pricingMap
    ) {
        $this->repo = $repo;
        $this->pricingMap = $pricingMap;
    }

    public function enter(string $plate, string $type): void
    {
        $existing = $this->repo->findOpenByPlate($plate);

        if ($existing !== null) {
            throw new \Exception("Este veículo já está estacionado.");
        }

        $vehicle = new Vehicle(
            id: 0,
            plate: $plate,
            type: $type,
            entryAt: new DateTime()
        );

        $this->repo->save($vehicle);
    }

    public function exit(string $plate): float
    {
        $vehicle = $this->repo->findOpenByPlate($plate);

        if ($vehicle === null) {
            throw new \Exception("Este veículo não está estacionado.");
        }

        $exitAt = new DateTime();

        if (!isset($this->pricingMap[$vehicle->type])) {
            throw new \Exception("Não existe estratégia de preço para o tipo {$vehicle->type}.");
        }

        $pricing = $this->pricingMap[$vehicle->type];

        $price = $pricing->calculate($vehicle, $exitAt);

        $closed = $vehicle->close($exitAt, $price);

        $this->repo->update($closed);

        return $price;
    }

    public function listAll(): array
    {
        return $this->repo->listAll();
    }
}
