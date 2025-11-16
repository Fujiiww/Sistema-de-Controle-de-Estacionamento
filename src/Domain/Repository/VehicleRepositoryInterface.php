<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Vehicle;

interface VehicleRepositoryInterface
{
    public function save(Vehicle $vehicle): void;

    public function findOpenByPlate(string $plate): ?Vehicle;

    public function update(Vehicle $vehicle): void;
    
    public function listAll(): array;
    
    public function delete(int $id): void;
}
