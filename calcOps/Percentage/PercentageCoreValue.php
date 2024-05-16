<?php

readonly class PercentageCoreValue
{

    public function __construct(private int|float $percentageVal, private int|float $percentage, private int|float $corePercentage) {}

    public function calc(int $dezimalPrecision = 2): int|float
    {
        return round((($this->percentageVal * $this->corePercentage) / $this->percentage), $dezimalPrecision);
    }
}