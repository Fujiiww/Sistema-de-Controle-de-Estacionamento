<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Vehicle;
use App\Domain\Repository\VehicleRepositoryInterface;
use DateTime;
use PDO;

class SqliteVehicleRepository implements VehicleRepositoryInterface
{
    private PDO $pdo;

    public function __construct(string $databasePath)
    {
        $this->pdo = new PDO('sqlite:' . $databasePath);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Cria a tabela caso não exista
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS vehicles (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                plate TEXT NOT NULL,
                type TEXT NOT NULL,
                entry_at TEXT NOT NULL,
                exit_at TEXT,
                price_paid REAL DEFAULT 0
            )
        ");
    }

    public function save(Vehicle $vehicle): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO vehicles (plate, type, entry_at)
            VALUES (:plate, :type, :entryAt)
        ");

        $stmt->execute([
            ':plate' => $vehicle->plate,
            ':type'  => $vehicle->type,
            ':entryAt' => $vehicle->entryAt->format('Y-m-d H:i:s'),
        ]);
    }

    public function update(Vehicle $vehicle): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE vehicles
            SET exit_at = :exitAt, price_paid = :pricePaid
            WHERE id = :id
        ");

        $stmt->execute([
            ':exitAt' => $vehicle->exitAt?->format('Y-m-d H:i:s'),
            ':pricePaid' => $vehicle->pricePaid,
            ':id' => $vehicle->id,
        ]);
    }

    public function findOpenByPlate(string $plate): ?Vehicle
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM vehicles
            WHERE plate = :plate AND exit_at IS NULL
            LIMIT 1
        ");

        $stmt->execute([':plate' => $plate]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->toVehicle($row) : null;
    }

    public function listAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM vehicles ORDER BY id DESC");

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'toVehicle'], $rows);
    }
    
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM vehicles WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
    
    private function toVehicle(array $row): Vehicle
    {
        return new Vehicle(
            id: (int) $row['id'],
            plate: $row['plate'],
            type: $row['type'],
            entryAt: new DateTime($row['entry_at']),
            exitAt: $row['exit_at'] ? new DateTime($row['exit_at']) : null,
            pricePaid: (float) $row['price_paid']
        );
    }
    
}
