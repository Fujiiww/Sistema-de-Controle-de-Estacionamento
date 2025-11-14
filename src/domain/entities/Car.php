 <?php

final class Car extends Vehicle

 {
 public function __construct(
    ?int $id,
    string $plate,
    \DateTimeImmutable $entryAt,
    ?\DateTimeImmutable $exitAt = null,
    float $pricePaid = 0.0
    ) {
        parent::__construct($id, $plate, 'car', $entryAt, $exitAt, $pricePaid);
    }
 }