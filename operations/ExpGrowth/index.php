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
        <h1>Exponentialrechnung</h1>
        <h3><mark>K<sub>n</sub> = K<sub>0</sub> × q<sup>n</sup></mark></h3>
        <p>Exponentialrechnung wird verwendet um eine <mark>Zahl (K)</mark> nach <mark>n</mark> Wiederholungen mit einem exponentiellen Wachstum (Anstieg) oder Abnahme (Abstieg) zu berechnen. Die Zahl nach n Wiederholungen ist dann <mark>K<sub>n</sub></mark>.</p>
    </div>

    <article class="basicArticle">
        <h3>Endwert <mark>K<sub>n</sub></mark> berechnen</h3>
        <br />
        <a role="button" href="ExpGrowthEnd.php">Zum Rechner</a>
        <a role="button" href="#" onclick="Kn()" class="contrast outline formula-btn">Formel</a>
    </article>

    <article class="basicArticle">
        <h3>Startwert <mark>K<sub>0</sub></mark> berechnen</h3>
        <br />
        <a role="button" href="ExpGrowthStart.php">Zum Rechner</a>
        <a role="button" href="#" onclick="K0()" class="contrast outline formula-btn">Formel</a>
    </article>

    <article class="basicArticle">
        <h3>Prozentsatz <mark>q</mark> und <mark>q</mark> berechnen</h3>
        <br />
        <a role="button" href="ExpGrowthPercentage.php">Zum Rechner</a>
    </article>

    <article class="basicArticle">
        <h3>Wiederholungen <mark>n</mark> berechnen</h3>
        <br />
        <a role="button" href="ExpGrowthN.php">Zum Rechner</a>
    </article>

    <script>
        function Kn() {
            Swal.fire({
                title: "Formel für <mark>K<sub>n</sub></mark>",
                html: 'Die Formel für K<sub>n</sub> ist:<br><mark>K<sub>n</sub> = K<sub>0</sub> × q<sup>n</sup></mark><br><mark>K<sub>0</sub></mark> ist dabei der Startwert, also der Wert der am Anfang gegeben wurde.<br><mark>q</mark> ist der Prozentsatz, dieser ergibt sich aus <i>p × 100 + 1</i>, wobei p für "Prozent" steht.' +
                    '<br><mark>n</mark> (genutzt in q<sup>n</sup>) ist die Anzahl der Wiederholungen, also wie oft K<sub>0</sub> exponiert werden soll.',
                icon: "question"
            });
        }

        function K0() {
            Swal.fire({
                title: "Formel für <mark>K<sub>0</sub></mark>",
                html: 'Die Formel für K<sub>0</sub> ist:<br><mark>K<sub>0</sub> = K<sub>n</sub> ÷ q<sup>n</sup></mark><br><mark>K<sub>n</sub></mark> ist dabei der Endwert, also der Wert der nach dem exponieren herauskommt.<br><mark>q</mark> ist der Prozentsatz, dieser ergibt sich aus <i>p × 100 + 1</i>, wobei p für "Prozent" steht.' +
                    '<br><mark>n</mark> (genutzt in q<sup>n</sup>) ist die Anzahl der Wiederholungen, also wie oft K<sub>n</sub> exponiert wurde.',
                icon: "question"
            });
        }
    </script>

</main>


<?php include "../../util/basicFooter.php"; ?>
</body>

</html>