<?php

namespace App\Domain\Pricing;

use App\Domain\Entity\Vehicle;
use DateTime;

interface PricingInterface
{
    public function calculate(Vehicle $vehicle, DateTime $exitAt): float;
}
