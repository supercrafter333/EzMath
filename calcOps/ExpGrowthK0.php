<?php
/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */


/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */

class ExpGrowthK0
{
    public function __construct(protected readonly int|float $Kn, protected readonly int $n, protected readonly float $p) {}

    public function p_to_q(): float
    {
        return $this->p / 100 + 1;
    }

    public function calc(int $dezimalPrecision = 2): float|int
    {
        return round($this->Kn / pow($this->p_to_q(), $this->n), $dezimalPrecision);
    }
}