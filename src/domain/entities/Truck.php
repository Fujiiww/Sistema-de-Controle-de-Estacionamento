<?

final class Truck extends Vehicle
{
    private ?int $axles;
    public function __construct(
    ?int $id,
    string $plate,
    \DateTimeImmutable $entryAt,
    ?\DateTimeImmutable $exitAt = null,
    float $pricePaid = 0.0,
    ?int $axles = null
    ) {
    parent::__construct($id, $plate, 'truck', $entryAt, $exitAt, $pricePaid);
    $this->axles = $axles;
    }
}