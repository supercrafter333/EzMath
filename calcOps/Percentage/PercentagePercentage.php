<?php

readonly class PercentagePercentage
{

    public function __construct(private int|float $coreVal, private int|float $percentageVal, private int|float $corePercentage = 100) {}

    public function calc(int $dezimalPrecision = 2): int|float
    {
        return round((($this->percentageVal * $this->corePercentage) / $this->coreVal), $dezimalPrecision);
    }
}