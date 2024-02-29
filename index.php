<?php
/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */
?>

<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
<?php
include "util/basicHeader.php";
$header = new basicHeader(__DIR__, "Home", ["mathematik", "rechnen", "taschenrechner", "rechner", "exponentiell", "bruch", "exponent", "wurzel", "potenz", "mathe", "ez", "math"]);

echo $header->__toString();
$res = "";
?>
</head>

<body>

<?php 
include "util/basicNav.php";
echo (new basicNav());
?>


<main role="main">

    <div class="bigTop">
        <br>
        <h1>EzMath</h1>
        <h3>Dein Mathe-Retter im Unterricht</h3>
        <br>
    </div>

</main>



</body>

</html>