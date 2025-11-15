<?php

namespace App\Domain\Pricing;

use App\Domain\Entity\Vehicle;
use DateTime;

class CarPricing implements PricingInterface
{
    private int $rate = 5; 

    public function calculate(Vehicle $vehicle, DateTime $exitAt): float
    {
        $seconds = $exitAt->getTimestamp() - $vehicle->entryAt->getTimestamp();
        $hours = (int) ceil($seconds / 3600);
        return $hours * $this->rate;
    }   
}