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
    $header = new basicHeader(__DIR__, "Exponentialrechnung", ["mathematik", "rechnen", "taschenrechner", "rechner", "exponentiell", "bruch", "exponent", "wurzel", "potenz", "mathe", "ez", "math"]);

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
        <h1>Prozentrechnung</h1>
        <h3><mark>G ÷ 100% = W ÷ p</mark></h3>
        <p>Prozentrechnung wird verwendet um eine prozentuale Veränderung oder einen prozentualen Unterschied festzustellen. <mark>G</mark> steht hier für den Grundwert, also der Wert, der 100% ist. <mark>W</mark> steht für den Prozentwert von <b>p</b>, also welchen Zahlenwert p (Prozentsatz) hat. <mark>p</mark> bezeichnet den prozentualen Anteil von <b>W</b> an <b>G</b>, also wie viel Prozent <b>W</b> von <b>G</b> sind.</p>
    </div>

    <article class="basicArticle">
        <h3>Prozentwert <mark>W</mark> berechnen</h3>
        <br />
        <a role="button" href="#" disabled="true">Zum Rechner</a>
        <a role="button" href="#" disabled="true" onclick="W()" class="contrast outline formula-btn">Formel</a>
    </article>

    <script>
        function W() {
            Swal.fire({
                title: "--- <mark>-<sub>-</sub></mark>",
                html: '<hr />',
                icon: "question"
            });
        }

        function K0() {
            Swal.fire({
                title: "--- <mark>-<sub>-</sub></mark>",
                html: '<hr />',
                icon: "question"
            });
        }
    </script>

</main>


<?php include "../../util/basicFooter.php"; ?>
</body>

</html>