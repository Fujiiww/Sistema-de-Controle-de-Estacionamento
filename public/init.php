<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\Repository\SqliteVehicleRepository;
use App\Application\ParkingService;
use App\Domain\Pricing\CarPricing;
use App\Domain\Pricing\MotorcyclePricing;
use App\Domain\Pricing\TruckPricing;

$dbPath = __DIR__ . '/../database/parking.sqlite';

if (!is_dir(__DIR__ . '/../database')) {
    mkdir(__DIR__ . '/../database', 0777, true);
}

$repo = new SqliteVehicleRepository($dbPath);

$pricingMap = [
    'car' => new CarPricing(),
    'motorcycle' => new MotorcyclePricing(),
    'truck' => new TruckPricing(),
];

$service = new ParkingService($repo, $pricingMap);
