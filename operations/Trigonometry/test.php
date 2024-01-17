<?php

include "../../util/TrigonometryHelper.php";

echo asin(5 / 12) / pi() * 180; //Works :)
echo "<br>\n" . TrigonometryHelper::sinSideHyp(30, 2.5);
echo "\n" . var_dump(sin(deg2rad(30)));
echo "\n" . var_dump(rad2deg(asin(5 / 12)));

echo PHP_EOL . PHP_EOL . var_dump("lul:" . TrigonometryHelper::tanAngle(2.5, 5));