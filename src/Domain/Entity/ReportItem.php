<?php

namespace App\Domain\Entity;

class ReportItem
{
public function __construct(
    public string $type,
    public int $count,
    public float $revenue
    ) {}
}