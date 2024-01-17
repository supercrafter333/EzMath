<?php

include "../../../util/TrigonometryHelper.php";
include "SmartResult.php";
include "../../../../calcOps/Pythagoras/PythagorasHyp.php";
include "../../../../calcOps/Pythagoras/PythagorasKat.php";

final class ComplexSmartCalculator
{

    public const ANGLE_ALPHA_gamma = [
        "type" => "angle",
        "sin" => ["a", "c"],
        "cos" => ["b", "c"],
        "tan" => ["a", "b"]
    ];
    public const ANGLE_BETA_gamma = [
        "type" => "angle",
        "sin" => ["b", "c"],
        "cos" => ["a", "c"],
        "tan" => ["b", "a"]
    ];

    public const ANGLE_BETA_alpha = [
        "type" => "angle",
        "sin" => ["b", "a"],
        "cos" => ["c", "a"],
        "tan" => ["b", "c"]
    ];
    public const ANGLE_GAMMA_alpha = [
        "type" => "angle",
        "sin" => ["c", "a"],
        "cos" => ["b", "a"],
        "tan" => ["c", "b"]
    ];

    public const ANGLE_ALPHA_beta = [
        "type" => "angle",
        "sin" => ["a", "b"],
        "cos" => ["c", "b"],
        "tan" => ["a", "c"]
    ];
    public const ANGLE_GAMMA_beta = [
        "type" => "angle",
        "sin" => ["c", "b"],
        "cos" => ["a", "b"],
        "tan" => ["c", "a"]
    ];

    public const AVAILABLE_ANGLES = [
        "gamma" => [self::ANGLE_ALPHA_gamma, self::ANGLE_BETA_gamma],
        "beta" => [self::ANGLE_ALPHA_beta, self::ANGLE_GAMMA_beta],
        "alpha" => [self::ANGLE_BETA_alpha, self::ANGLE_GAMMA_alpha],
    ];


    /**
     * @param string $searched
     * @param array $angles
     * @param array $sides
     * @return SmartResult|null
     */
    public static function getResult(string $searched, array $angles, array $sides): SmartResult|null
    {
        foreach ($angles as $angle => $value)
            if ($value == 0 || $value == null) unset($angles[$angle]);
        foreach ($sides as $side => $value)
            if ($value == 0 || $value == null) unset($sides[$side]);

        $searchedType = match ($searched) {
            "alpha", "beta", "gamma" => "angle",
            "a", "b", "c" => "side"
        };

        if (!self::validateAngles($angles)) return null;

        if (count(self::getRightAngleAngles($angles)) > 1) return null;
        $rightAngle = array_keys(self::getRightAngleAngles($angles))[0];

        if (empty($sides)) return null;

        if (strtolower($rightAngle) === "gamma")
            return self::calcForGamma($searched, self::getNonRightAngleAngles($angles), $sides, $searchedType);
        if (strtolower($rightAngle) === "alpha")
            return self::calcForAlpha($searched, self::getNonRightAngleAngles($angles), $sides, $searchedType);
        if (strtolower($rightAngle) === "beta")
            return self::calcForBeta($searched, self::getNonRightAngleAngles($angles), $sides, $searchedType);
        return null;

       /* $sideCount = count($sides);

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
        }*/
    }



    public static function calcForGamma(string $searched, array $angles, array $sides, string $searchedType): SmartResult|null
    {

        if (count($angles) === 1 && $searchedType === "angle")
            return new SmartResult($searched, [array_keys($angles)[0] => $angles[array_keys($angles)[0]]], "Innenwinkelsatz", (90 - array_values($angles)[0]));

        if (empty($sides)) return null;
        $sideCount = count($sides);

        $sideTypes = [
            "hyp" => "c",
            "kat" => ["a", "b"]
        ];

        if ($searchedType === "side" && count($sides) == 2) {
            if (isset($sides[$searched])) return new SmartResult($searched, [$searched => $sides[$searched]], "---", $sides[$searched]);

            if (self::simpleArraySearch($sideTypes["kat"], $sides)) {
                $sideVals = array_values($sides);
                $sideKeys = array_keys($sides);
                $hyp = (new PythagorasHyp($sideVals[0], $sideVals[1]))->calc(8);
                return new SmartResult($searched, [$sideKeys[0] => $sideVals[0], $sideKeys[1] => $sideVals[1]], "Pythagoras (Hyp)", $hyp);
            } elseif (isset($sides[$sideTypes["hyp"]]) && (isset($sides[$sideTypes["kat"][0]]) || isset($sides[$sideTypes["kat"][1]]))) {
                $kat = null;
                if (isset($sides[$sideTypes["kat"][0]])) $kat = [0, $sides[$sideTypes["kat"][0]]];
                if (isset($sides[$sideTypes["kat"][1]])) $kat = [1, $sides[$sideTypes["kat"][1]]];
                if ($kat !== null) {
                    $hyp = $sides[$sideTypes["hyp"]];
                    $searchedKat = (new PythagorasKat($hyp, $kat[1]))->calc(8);
                    return new SmartResult($searched, [$sideTypes["hyp"] => $hyp, $sideTypes["kat"][$kat[0]] => $kat[1]], "Pythagoras (Kat)", $searchedKat);
                }
            }
        }

        if ($searched === "alpha") {
            if ($sideCount < 2) return null;

            $availableOperations = self::ANGLE_ALPHA_gamma;

            if (self::simpleArraySearch($availableOperations["sin"], $sides)) {
                $vals = array_values($availableOperations["sin"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "sin", TrigonometryHelper::sinAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["cos"], $sides)) {
                $vals = array_values($availableOperations["cos"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "cos", TrigonometryHelper::cosAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["tan"], $sides)) {
                $vals = array_values($availableOperations["tan"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "tan", TrigonometryHelper::tanAngle($sides[$vals[0]], $sides[$vals[1]]));
            }
        }

        if ($searched === "beta") {
            if ($sideCount < 2) return null;

            $availableOperations = self::ANGLE_BETA_gamma;

            if (self::simpleArraySearch($availableOperations["sin"], $sides)) {
                $vals = array_values($availableOperations["sin"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "sin", TrigonometryHelper::sinAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["cos"], $sides)) {
                $vals = array_values($availableOperations["cos"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "cos", TrigonometryHelper::cosAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["tan"], $sides)) {
                $vals = array_values($availableOperations["tan"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "tan", TrigonometryHelper::tanAngle($sides[$vals[0]], $sides[$vals[1]]));
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
                        if (isset($sides["a"])) return new SmartResult($searched, ["a" => $sides["a"]], "---", $sides["a"]);
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideOpp($angles["alpha"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideOpp($angles["alpha"], $sides[$zeroSide]));
                        break;
                    case "b":
                        if (isset($sides["b"])) return new SmartResult($searched, ["b" => $sides["b"]], "---", $sides["b"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideAdj($angles["alpha"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideAdj($angles["alpha"], $sides[$zeroSide]));
                        break;
                    case "c":
                        if (isset($sides["c"])) return new SmartResult($searched, ["c" => $sides["c"]], "---", $sides["c"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideHyp($angles["alpha"], $sides[$zeroSide]));
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideHyp($angles["alpha"], $sides[$zeroSide]));
                        break;
                };
            }
            if ($angleKeys[0] === "beta") {
                switch ($searchedSide) {
                    case "a":
                        if (isset($sides["a"])) return new SmartResult($searched, ["a" => $sides["a"]], "---", $sides["a"]);
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideAdj($angles["beta"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideAdj($angles["beta"], $sides[$zeroSide]));
                        break;
                    case "b":
                        if (isset($sides["b"])) return new SmartResult($searched, ["b" => $sides["b"]], "---", $sides["b"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideOpp($angles["beta"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideOpp($angles["beta"], $sides[$zeroSide]));
                        break;
                    case "c":
                        if (isset($sides["c"])) return new SmartResult($searched, ["c" => $sides["c"]], "---", $sides["c"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideHyp($angles["beta"], $sides[$zeroSide]));
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideHyp($angles["beta"], $sides[$zeroSide]));
                        break;
                };
            }
        }

        return null;
    }


    public static function calcForAlpha(string $searched, array $angles, array $sides, string $searchedType): SmartResult|null
    {

        if (count($angles) === 1 && $searchedType === "angle")
            return new SmartResult($searched, [array_keys($angles)[0] => $angles[array_keys($angles)[0]]], "Innenwinkelsatz", (90 - array_values($angles)[0]));

        if (empty($sides)) return null;
        $sideCount = count($sides);

        $sideTypes = [
            "hyp" => "a",
            "kat" => ["c", "b"]
        ];

        if ($searchedType === "side" && count($sides) == 2) {
            if (isset($sides[$searched])) return new SmartResult($searched, [$searched => $sides[$searched]], "---", $sides[$searched]);

            if (self::simpleArraySearch($sideTypes["kat"], $sides)) {
                $sideVals = array_values($sides);
                $sideKeys = array_keys($sides);
                $hyp = (new PythagorasHyp($sideVals[0], $sideVals[1]))->calc(8);
                return new SmartResult($searched, [$sideKeys[0] => $sideVals[0], $sideKeys[1] => $sideVals[1]], "Pythagoras (Hyp)", $hyp);
            } elseif (isset($sides[$sideTypes["hyp"]]) && (isset($sides[$sideTypes["kat"][0]]) || isset($sides[$sideTypes["kat"][1]]))) {
                $kat = null;
                if (isset($sides[$sideTypes["kat"][0]])) $kat = [0, $sides[$sideTypes["kat"][0]]];
                if (isset($sides[$sideTypes["kat"][1]])) $kat = [1, $sides[$sideTypes["kat"][1]]];
                if ($kat !== null) {
                    $hyp = $sides[$sideTypes["hyp"]];
                    $searchedKat = (new PythagorasKat($hyp, $kat[1]))->calc(8);
                    return new SmartResult($searched, [$sideTypes["hyp"] => $hyp, $sideTypes["kat"][$kat[0]] => $kat[1]], "Pythagoras (Kat)", $searchedKat);
                }
            }
        }

        if ($searched === "gamma") {
            if ($sideCount < 2) return null;

            $availableOperations = self::ANGLE_GAMMA_alpha;

            if (self::simpleArraySearch($availableOperations["sin"], $sides)) {
                $vals = array_values($availableOperations["sin"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "sin", TrigonometryHelper::sinAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["cos"], $sides)) {
                $vals = array_values($availableOperations["cos"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "cos", TrigonometryHelper::cosAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["tan"], $sides)) {
                $vals = array_values($availableOperations["tan"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "tan", TrigonometryHelper::tanAngle($sides[$vals[0]], $sides[$vals[1]]));
            }
        }

        if ($searched === "beta") {
            if ($sideCount < 2) return null;

            $availableOperations = self::ANGLE_BETA_alpha;

            if (self::simpleArraySearch($availableOperations["sin"], $sides)) {
                $vals = array_values($availableOperations["sin"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "sin", TrigonometryHelper::sinAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["cos"], $sides)) {
                $vals = array_values($availableOperations["cos"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "cos", TrigonometryHelper::cosAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["tan"], $sides)) {
                $vals = array_values($availableOperations["tan"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "tan", TrigonometryHelper::tanAngle($sides[$vals[0]], $sides[$vals[1]]));
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
                        if (isset($sides["a"])) return new SmartResult($searched, ["a" => $sides["a"]], "---", $sides["a"]);
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideHyp($angles["gamma"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideHyp($angles["gamma"], $sides[$zeroSide]));
                        break;
                    case "b":
                        if (isset($sides["b"])) return new SmartResult($searched, ["b" => $sides["b"]], "---", $sides["b"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideAdj($angles["gamma"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideAdj($angles["gamma"], $sides[$zeroSide]));
                        break;
                    case "c":
                        if (isset($sides["c"])) return new SmartResult($searched, ["c" => $sides["c"]], "---", $sides["c"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideOpp($angles["gamma"], $sides[$zeroSide]));
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideOpp($angles["gamma"], $sides[$zeroSide]));
                        break;
                };
            }
            if ($angleKeys[0] === "beta") {
                switch ($searchedSide) {
                    case "a":
                        if (isset($sides["a"])) return new SmartResult($searched, ["a" => $sides["a"]], "---", $sides["a"]);
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideHyp($angles["beta"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideHyp($angles["beta"], $sides[$zeroSide]));
                        break;
                    case "b":
                        if (isset($sides["b"])) return new SmartResult($searched, ["b" => $sides["b"]], "---", $sides["b"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideOpp($angles["beta"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideOpp($angles["beta"], $sides[$zeroSide]));
                        break;
                    case "c":
                        if (isset($sides["c"])) return new SmartResult($searched, ["c" => $sides["c"]], "---", $sides["c"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideAdj($angles["beta"], $sides[$zeroSide]));
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["beta" => $angles["beta"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideAdj($angles["beta"], $sides[$zeroSide]));
                        break;
                };
            }
        }

        return null;
    }


    public static function calcForBeta(string $searched, array $angles, array $sides, string $searchedType): SmartResult|null
    {

        if (count($angles) === 1 && $searchedType === "angle")
            return new SmartResult($searched, [array_keys($angles)[0] => $angles[array_keys($angles)[0]]], "Innenwinkelsatz", (90 - array_values($angles)[0]));

        if (empty($sides)) return null;
        $sideCount = count($sides);

        $sideTypes = [
            "hyp" => "c",
            "kat" => ["a", "b"]
        ];

        if ($searchedType === "side" && count($sides) == 2) {
            if (isset($sides[$searched])) return new SmartResult($searched, [$searched => $sides[$searched]], "---", $sides[$searched]);

            if (self::simpleArraySearch($sideTypes["kat"], $sides)) {
                $sideVals = array_values($sides);
                $sideKeys = array_keys($sides);
                $hyp = (new PythagorasHyp($sideVals[0], $sideVals[1]))->calc(8);
                return new SmartResult($searched, [$sideKeys[0] => $sideVals[0], $sideKeys[1] => $sideVals[1]], "Pythagoras (Hyp)", $hyp);
            } elseif (isset($sides[$sideTypes["hyp"]]) && (isset($sides[$sideTypes["kat"][0]]) || isset($sides[$sideTypes["kat"][1]]))) {
                $kat = null;
                if (isset($sides[$sideTypes["kat"][0]])) $kat = [0, $sides[$sideTypes["kat"][0]]];
                if (isset($sides[$sideTypes["kat"][1]])) $kat = [1, $sides[$sideTypes["kat"][1]]];
                if ($kat !== null) {
                    $hyp = $sides[$sideTypes["hyp"]];
                    $searchedKat = (new PythagorasKat($hyp, $kat[1]))->calc(8);
                    return new SmartResult($searched, [$sideTypes["hyp"] => $hyp, $sideTypes["kat"][$kat[0]] => $kat[1]], "Pythagoras (Kat)", $searchedKat);
                }
            }
        }

        if ($searched === "alpha") {
            if ($sideCount < 2) return null;

            $availableOperations = self::ANGLE_ALPHA_beta;

            if (self::simpleArraySearch($availableOperations["sin"], $sides)) {
                $vals = array_values($availableOperations["sin"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "sin", TrigonometryHelper::sinAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["cos"], $sides)) {
                $vals = array_values($availableOperations["cos"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "cos", TrigonometryHelper::cosAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["tan"], $sides)) {
                $vals = array_values($availableOperations["tan"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "tan", TrigonometryHelper::tanAngle($sides[$vals[0]], $sides[$vals[1]]));
            }
        }

        if ($searched === "gamma") {
            if ($sideCount < 2) return null;

            $availableOperations = self::ANGLE_GAMMA_beta;

            if (self::simpleArraySearch($availableOperations["sin"], $sides)) {
                $vals = array_values($availableOperations["sin"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "sin", TrigonometryHelper::sinAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["cos"], $sides)) {
                $vals = array_values($availableOperations["cos"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "cos", TrigonometryHelper::cosAngle($sides[$vals[0]], $sides[$vals[1]]));
            } elseif (self::simpleArraySearch($availableOperations["tan"], $sides)) {
                $vals = array_values($availableOperations["tan"]);
                return new SmartResult($searched, [$vals[0] => $sides[$vals[0]], $vals[1] => $sides[$vals[1]]], "tan", TrigonometryHelper::tanAngle($sides[$vals[0]], $sides[$vals[1]]));
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
                        if (isset($sides["a"])) return new SmartResult($searched, ["a" => $sides["a"]], "---", $sides["a"]);
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideOpp($angles["alpha"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideOpp($angles["alpha"], $sides[$zeroSide]));
                        break;
                    case "b":
                        if (isset($sides["b"])) return new SmartResult($searched, ["b" => $sides["b"]], "---", $sides["b"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideHyp($angles["alpha"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideHyp($angles["alpha"], $sides[$zeroSide]));
                        break;
                    case "c":
                        if (isset($sides["c"])) return new SmartResult($searched, ["c" => $sides["c"]], "---", $sides["c"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideAdj($angles["alpha"], $sides[$zeroSide]));
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["alpha" => $angles["alpha"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideAdj($angles["alpha"], $sides[$zeroSide]));
                        break;
                };
            }
            if ($angleKeys[0] === "gamma") {
                switch ($searchedSide) {
                    case "a":
                        if (isset($sides["a"])) return new SmartResult($searched, ["a" => $sides["a"]], "---", $sides["a"]);
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideAdj($angles["gamma"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideAdj($angles["gamma"], $sides[$zeroSide]));
                        break;
                    case "b":
                        if (isset($sides["b"])) return new SmartResult($searched, ["b" => $sides["b"]], "---", $sides["b"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "cos", TrigonometryHelper::cosSideHyp($angles["gamma"], $sides[$zeroSide]));
                        if ($zeroSide === "c")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideHyp($angles["gamma"], $sides[$zeroSide]));
                        break;
                    case "c":
                        if (isset($sides["c"])) return new SmartResult($searched, ["c" => $sides["c"]], "---", $sides["c"]);
                        if ($zeroSide === "a")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "tan", TrigonometryHelper::tanSideOpp($angles["gamma"], $sides[$zeroSide]));
                        if ($zeroSide === "b")
                            return new SmartResult($searched, ["gamma" => $angles["gamma"], $zeroSide => $sides[$zeroSide]], "sin", TrigonometryHelper::sinSideOpp($angles["gamma"], $sides[$zeroSide]));
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

    private static function validateAngles(array $angles): bool
    {
        return !empty($angle) && in_array(90, $angles);
    }

    private static function getNonRightAngleAngles(array $angles): array
    {
        $res = [];

        foreach ($angles as $angle => $value)
            if ($value < 90) $res[$angle] = $value;

        return $res;
    }

    private static function getRightAngleAngles(array $angles): array
    {
        $res = [];

        foreach ($angles as $angle => $value)
            if ($value == 90) $res[$angle] = $value;

        return $res;
    }
}