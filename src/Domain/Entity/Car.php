<?php

namespace App\Domain\Entity;

use DateTime;

final class Car extends Vehicle
{
    public function __construct(
        public int $id,
        public string $plate,
        public DateTime $entryAt,
        public ?DateTime $exitAt = null,
        public float $pricePaid = 0.0
    ) {
        parent::__construct($id, $plate, 'car', $entryAt, $exitAt, $pricePaid);
    }
}
