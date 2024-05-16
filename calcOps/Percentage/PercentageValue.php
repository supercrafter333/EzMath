<?php

readonly class PercentageValue
{

    public function __construct(private int|float $coreVal, private int|float $percentage, private int|float $corePercentage = 100) {}

    public function calc(int $dezimalPrecision = 2): int|float
    {
        return round((($this->coreVal * $this->percentage) / $this->corePercentage), $dezimalPrecision);
    }
}