<?php

namespace App\Domain\Pricing;

use App\Domain\Entity\Vehicle;
use DateTime;

class TruckPricing implements PricingInterface
{
    private int $rate = 10;
    
    public function calculate(Vehicle $vehicle, DateTime $exitAt): float
    {
        $seconds = $exitAt->getTimestamp() - $vehicle->entryAt->getTimestamp();
        $hours = (int) ceil($seconds / 3600);
        return $hours * $this->rate;
    }
}