<?php

class PythagorasKat
{
    public function __construct(protected readonly int|float $hyp, protected readonly int|float $kat) {}

    public function calc(int $dezimalPrecision = 2): int|float|false
    {
        if ($this->hyp <= $this->kat) return false;
        return round(sqrt(pow($this->hyp, 2) - pow($this->kat, 2)), $dezimalPrecision);
    }
}