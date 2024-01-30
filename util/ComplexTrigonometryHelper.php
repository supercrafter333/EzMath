<?php

final class ComplexTrigonometryHelper
{

    public static function sinAngle(int|float $sideLengthOpp, int|float $sideLengthHyp, string $searched): array
    {
        $result = rad2deg(asin($sideLengthOpp / $sideLengthHyp));
        return [
            "result" => $result,
            "calcWay" => ["asin(GK ÷ Hyp) = $searched", "asin({$sideLengthOpp}° ÷ {$sideLengthHyp}°) = " . round($result, 2) . "°"]
            ];
    }

    public static function sinSideOpp(int|float $sideAngle, int|float $sideLengthHyp, string $searched): array
    {
        $result = sin(deg2rad($sideAngle)) * $sideLengthHyp;
        return [
            "result" => $result,
            "calcWay" => ["<b>sin</b>WINKEL × Hyp = GK ({$searched})", "sin{$sideAngle}° × {$sideLengthHyp} = " . round($result, 2)]
        ];
    }

    public static function sinSideHyp(int|float $sideAngle, int|float $sideLengthOpp, string $searched): array
    {
        $result = $sideLengthOpp / sin(deg2rad($sideAngle));
        return [
            "result" => $result,
            "calcWay" => ["GK ÷ <b>sin</b>WINKEL = Hyp ({$searched})", "{$sideLengthOpp} ÷ sin{$sideAngle}° = " . round($result, 2)]
        ];
    }

    public static function cosAngle(int|float $sideLengthAdj, int|float $sideLengthHyp, string $searched): array
    {
        $result = rad2deg(acos($sideLengthAdj / $sideLengthHyp));
        return [
            "result" => $result,
            "calcWay" => ["acos(AK ÷ Hyp) = $searched", "acos({$sideLengthAdj}° ÷ {$sideLengthHyp}°) = " . round($result, 2) . "°"]
        ];
    }

    public static function cosSideAdj(int|float $sideAngle, int|float $sideLengthHyp, string $searched): array
    {
        $result = cos(deg2rad($sideAngle)) * $sideLengthHyp;
        return [
            "result" => $result,
            "calcWay" => ["<b>cos</b>WINKEL × Hyp = AK ({$searched})", "cos{$sideAngle}° × {$sideLengthHyp} = " . round($result, 2)]
        ];
    }

    public static function cosSideHyp(int|float $sideAngle, int|float $sideLengthAdj, string $searched): array
    {
        $result = $sideLengthAdj / cos(deg2rad($sideAngle));
        return [
            "result" => $result,
            "calcWay" => ["AK ÷ <b>cos</b>WINKEL = Hyp ({$searched})", "{$sideLengthAdj} ÷ cos{$sideAngle}° = " . round($result, 2)]
        ];
    }

    public static function tanAngle(int|float $sideLengthOpp, int|float $sideLengthAdj, string $searched): array
    {
        $result = rad2deg(atan($sideLengthOpp / $sideLengthAdj));
        return [
            "result" => $result,
            "calcWay" => ["atan(GK ÷ AK) = $searched", "atan({$sideLengthOpp}° ÷ {$sideLengthAdj}°) = " . round($result, 2) . "°"]
        ];
    }

    public static function tanSideOpp(int|float $sideAngle, int|float $sideLengthAdj, string $searched): array
    {
        $result = tan(deg2rad($sideAngle)) * $sideLengthAdj;
        return [
            "result" => $result,
            "calcWay" => ["<b>tan</b>WINKEL × AK = GK ({$searched})", "tan{$sideAngle}° ÷ {$sideLengthAdj} = " . round($result, 2)]
        ];
    }

    public static function tanSideAdj(int|float $sideAngle, int|float $sideLengthOpp, string $searched): array
    {
        $result = $sideLengthOpp / tan(deg2rad($sideAngle));
        return [
            "result" => $result,
            "calcWay" => ["GK ÷ <b>tan</b>WINKEL = AK ({$searched})", "{$sideLengthOpp} ÷ tan{$sideAngle}° = " . round($result, 2)]
        ];
    }
}