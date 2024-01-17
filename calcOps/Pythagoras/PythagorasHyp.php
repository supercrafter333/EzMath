<?php

class PythagorasHyp
{
    public function __construct(protected readonly int|float $kat1, protected readonly int|float $kat2) {}

    public function calc(int $dezimalPrecision = 2): int|float
    {
        return round(sqrt(pow($this->kat1, 2) + pow($this->kat2, 2)), $dezimalPrecision);
    }
}