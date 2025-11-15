<?php 

namespace App\Domain\Entity;

use DateTime;

class Vehicle
{
    public function __construct(
        public int $id,
        public string $plate,
        public string $type,
        public DateTime $entryAt,
        public ?DateTime $exitAt = null,
        public float $pricePaid = 0.0
    ) {}

    public function close(DateTime $exitAt, float $paid): static
    {
        return new self($this->id, $this->plate, $this->type, $this->entryAt, $exitAt, $paid);
    }
}
