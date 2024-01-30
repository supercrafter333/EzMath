<?php

include "../../../util/TrigonometryHelper.php";

final class SmartCalculator
{

    public const ANGLE_ALPHA = [
        "type" => "angle",
        "sin" => ["a", "c"],
        "cos" => ["b", "c"],
        "tan" => ["a", "b"]
    ];

    public const ANGLE_BETA = [
        "type" => "angle",
        "sin" => ["b", "c"],
        "cos" => ["a", "c"],
        "tan" => ["b", "a"]
    ];


    /**
     * @param string $searched
     * @param array $angles
     * @param array $sides
     * @return array<array<string, array>, int|float>|null
     */
    public static function getResult(string $searched, array $angles, array $sides): array|null
    {
        foreach ($angles as $angle => $value)
            if ($value == 0 || $value == null) unset($angles[$angle]);
        foreach ($sides as $side => $value)
            if ($value == 0 || $value == null) unset($sides[$side]);

        $searchedType = match ($searched) {
            "alpha", "beta" => "angle",
            "a", "b", "c" => "side"
        };

        if (count($angles) === 1 && $searchedType === "angle") return [[$searched, ["---", array_keys($angles)[0] => $angles[array_keys($angles)[0]]]], 90 - array_values($angles)[0]];

        if (empty($sides)) return null;
        $sideCount = count($sides);

        if ($searched === "alpha") {
            if ($sideCount < 2) return null;

            $availableOperations = self::ANGLE_ALPHA;
//            var_dump(self::simpleArraySearch($availableOperations["tan"], $sides));

            if (self::simpleArraySearch($availableOperations["sin"], $sides)) {
                $vals = array_values($availableOperations["sin"]);
                return [[$searched, ["sin", [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]]]], TrigonometryHelper::sinAngle($sides[$vals[0]], $sides[$vals[1]])];
            } elseif (self::simpleArraySearch($availableOperations["cos"], $sides)) {
                $vals = array_values($availableOperations["cos"]);
                return [[$searched, ["cos", [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]]]], TrigonometryHelper::cosAngle($sides[$vals[0]], $sides[$vals[1]])];
            } elseif (self::simpleArraySearch($availableOperations["tan"], $sides)) {
                $vals = array_values($availableOperations["tan"]);
                return [[$searched, ["tan", [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]]]], TrigonometryHelper::tanAngle($sides[$vals[0]], $sides[$vals[1]])];
            }
        }

        if ($searched === "beta") {
            if ($sideCount < 2) return null;

            $availableOperations = self::ANGLE_BETA;

            if (self::simpleArraySearch($availableOperations["sin"], $sides)) {
                $vals = array_values($availableOperations["sin"]);
                return [[$searched, ["sin", [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]]]], TrigonometryHelper::sinAngle($sides[$vals[0]], $sides[$vals[1]])];
            } elseif (self::simpleArraySearch($availableOperations["cos"], $sides)) {
                $vals = array_values($availableOperations["cos"]);
                return [[$searched, ["cos", [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]]]], TrigonometryHelper::cosAngle($sides[$vals[0]], $sides[$vals[1]])];
            } elseif (self::simpleArraySearch($availableOperations["tan"], $sides)) {
                $vals = array_values($availableOperations["tan"]);
                return [[$searched, ["tan", [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]]]], TrigonometryHelper::tanAngle($sides[$vals[0]], $sides[$vals[1]])];
            }
        }

        if (empty($angles)) return null;

        if ($searchedType === "side") {
            $angleKeys = array_keys($angles);
            $sideKeys = array_keys($sides);
            $searchedSide = $searched;
            $zeroSide = $sideKeys[0];
            if ($angleKeys[0] === "alpha") {
                switch ($searchedSide) {
                    case "a":
                        if (isset($sides["a"])) return [[$searched, ["---", array_merge($angles, $sides)]], $sides["a"]];
                        if ($zeroSide === "b")
                            return [[$searched, ["tan", ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::tanSideOpp($angles["alpha"], $sides[$zeroSide])];
                        if ($zeroSide === "c")
                            return [[$searched, ["sin", ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::sinSideOpp($angles["alpha"], $sides[$zeroSide])];
                    break;
                    case "b":
                        if (isset($sides["b"])) return ["---", $sides["b"]];
                        if ($zeroSide === "a")
                            return [[$searched, ["tan", ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::tanSideAdj($angles["alpha"], $sides[$zeroSide])];
                        if ($zeroSide === "c")
                            return [[$searched, ["cos", ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::cosSideAdj($angles["alpha"], $sides[$zeroSide])];
                        break;
                    case "c":
                        if (isset($sides["c"])) return ["---", $sides["c"]];
                        if ($zeroSide === "a")
                            return [[$searched, ["sin", ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::sinSideHyp($angles["alpha"], $sides[$zeroSide])];
                        if ($zeroSide === "b")
                            return [[$searched, ["cos", ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::cosSideHyp($angles["alpha"], $sides[$zeroSide])];
                        break;
                };
            }
            if ($angleKeys[0] === "beta") {
                switch ($searchedSide) {
                    case "a":
                        if (isset($sides["a"])) return ["---", $sides["a"]];
                        if ($zeroSide === "b")
                            return [[$searched, ["tan", ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::tanSideAdj($angles["beta"], $sides[$zeroSide])];
                        if ($zeroSide === "c")
                            return [[$searched, ["cos", ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::cosSideAdj($angles["beta"], $sides[$zeroSide])];
                        break;
                    case "b":
                        if (isset($sides["b"])) return ["---", $sides["b"]];
                        if ($zeroSide === "a")
                            return [[$searched, ["tan", ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::tanSideOpp($angles["beta"], $sides[$zeroSide])];
                        if ($zeroSide === "c")
                            return [[$searched, ["sin", ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::sinSideOpp($angles["beta"], $sides[$zeroSide])];
                        break;
                    case "c":
                        if (isset($sides["c"])) return ["---", $sides["c"]];
                        if ($zeroSide === "a")
                            return [[$searched, ["cos", ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::cosSideHyp($angles["beta"], $sides[$zeroSide])];
                        if ($zeroSide === "b")
                            return [[$searched, ["sin", ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]]]], TrigonometryHelper::sinSideHyp($angles["beta"], $sides[$zeroSide])];
                        break;
                };
            }
        }

        return null;
    }

    /**
     * @param array $searchedItems
     * @param array $haystack
     * @return bool
     */
    private static function simpleArraySearch(array $searchedItems, array $haystack): bool
    {
        foreach ($searchedItems as $item)
            if (!isset($haystack[$item])) return false;
        return true;
    }
}