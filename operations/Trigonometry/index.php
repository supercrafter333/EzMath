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
    include "../../util/basicHeader.php";
    $header = new basicHeader(__DIR__, "Pythagoras", ["mathematik", "rechnen", "taschenrechner", "rechner", "exponentiell", "bruch", "exponent", "wurzel", "potenz", "mathe", "ez", "math"]);

    echo $header->__toString();
    ?>
</head>

<body>

<?php
include "../../util/basicNav.php";
echo (new basicNav());
?>

<br>

<main style="margin-top: 0;">

    <div class="headline">
        <h1>Trigonometrie</h1>
        <!--<h3><mark>FORMEL</mark></h3>
        <p>ERKLÄRUNG</p>-->
    </div>

    <article class="basicArticle">
        <h3><mark>BETA</mark> Schlauer Rechner</h3>
        <p>Rechnet, ohne großen Aufwand, das beste Ergebnis aus.</p>
        <br />
        <a role="button" class="contrast" href="smartCalculator">Zum schlauen Rechner</a>
    </article>

    <script>
        function Hyp() {
            Swal.fire({
                title: "Formel für <mark>Hyp</mark>",
                html: 'Die Formel für die Hypotenuse (Hyp) ist:<br>' +
                    '<mark>Hyp = √(Kath<sup>2</sup> + Kath<sup>2</sup>)</mark><br>' +
                    '<mark>Hyp</mark> ist die Hypothenuse, also die Seite, die dem rechten Winkel (⦝) gegenüber liegt. Diese Seite ist gleichzeitig die längste.' +
                    '<mark>Kath</mark> sind die zwei Katheten eines jeden rechtwinkligen Dreiecks. Dies sind die beiden kürzeren Seiten, die nicht dem rechten Winkel gegenüber liegen, sie sind links und echt von ihm.',
                icon: "question"
            });
        }

        /*function K0() {
            Swal.fire({
                title: "--- <mark>-<sub>-</sub></mark>",
                html: '<hr />',
                icon: "question"
            });
        }*/
    </script>

</main>


<?php include "../../util/basicFooter.php"; ?>
</body>

</html>