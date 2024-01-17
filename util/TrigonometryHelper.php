<?php

final class TrigonometryHelper
{

    public static function sinAngle(int|float $sideLengthOpp, int|float $sideLengthHyp): int|float
    {
        return rad2deg(asin($sideLengthOpp / $sideLengthHyp));
    }

    public static function sinSideOpp(int|float $sideAngle, int|float $sideLengthHyp): int|float
    {
        return sin(deg2rad($sideAngle)) * $sideLengthHyp;
    }

    public static function sinSideHyp(int|float $sideAngle, int|float $sideLengthOpp): int|float
    {
        return $sideLengthOpp / sin(deg2rad($sideAngle));
    }

    public static function cosAngle(int|float $sideLengthOpp, int|float $sideLengthHyp): int|float
    {
        return rad2deg(acos($sideLengthOpp / $sideLengthHyp));
    }

    public static function cosSideAdj(int|float $sideAngle, int|float $sideLengthHyp): int|float
    {
        return cos(deg2rad($sideAngle)) * $sideLengthHyp;
    }

    public static function cosSideHyp(int|float $sideAngle, int|float $sideLengthAdj): int|float
    {
        return $sideLengthAdj / cos(deg2rad($sideAngle));
    }

    public static function tanAngle(int|float $sideLengthOpp, int|float $sideLengthAdj): int|float
    {
        return rad2deg(atan($sideLengthOpp / $sideLengthAdj));
    }

    public static function tanSideOpp(int|float $sideAngle, int|float $sideLengthAdj): int|float
    {
        return tan(deg2rad($sideAngle)) * $sideLengthAdj;
    }

    public static function tanSideAdj(int|float $sideAngle, int|float $sideLengthOpp): int|float
    {
        return $sideLengthOpp / tan(deg2rad($sideAngle));
    }
}