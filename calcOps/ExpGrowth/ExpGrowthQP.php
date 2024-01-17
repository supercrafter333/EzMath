<?php
/*
 *  Copyright (c) 2024 by Christoph Willi Regensburger
 *
 *  Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 *  Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 *  bei Christoph Regensburger.
 *  Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */

class ExpGrowthQP
{
    public function __construct(protected readonly int|float $K0, protected readonly int|float $Kn, protected readonly int $n) {}

    public function calc(int $dezimalPrecision = 2): array
    {
        $q = round(pow(($this->Kn / $this->K0), (1/$this->n)), $dezimalPrecision);
        $p = round(($q - 1) * 100, $dezimalPrecision);
        return ["q" => $q, "p" => $p];
    }
}