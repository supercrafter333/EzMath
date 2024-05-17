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
        <a role="button" href="PercentageValue.php">Zum Rechner</a>
        <a role="button" href="#" onclick="W()" class="contrast outline formula-btn">Formel</a>
    </article>

    <article class="basicArticle">
        <h3>Grundwert <mark>G</mark> berechnen</h3>
        <br />
        <a role="button" href="PercentageCoreValue.php">Zum Rechner</a>
        <a role="button" href="#" onclick="G()" class="contrast outline formula-btn">Formel</a>
    </article>

    <article class="basicArticle">
        <h3>Prozentsatz <mark>p</mark> berechnen</h3>
        <br />
        <a role="button" href="PercentagePercentage.php">Zum Rechner</a>
        <a role="button" href="#" onclick="p()" class="contrast outline formula-btn">Formel</a>
    </article>

    <script>
        function W() {
            Swal.fire({
                title: "Formel für <mark>K<sub>0</sub></mark>",
                html: 'Die Formel für W ist:<br><mark>W = G × p ÷ 100%<sub>(Grundprozentsatz)</sub></mark><br><mark>G</mark> ist hier der Grundwert, also der Wert der von dem jede prozentuale Veränderung ausgeht.<br><mark>p</mark> ist der Prozentsatz, dieser ist immer in der Einheit % und gibt die prozentuale Veränderung für W von G an.' +
                    '<br><mark>W</mark> ist der Wert der prozentualen Veränderung von G.',
                icon: "question"
            });
        }
        function G() {
            Swal.fire({
                title: "Formel für <mark>G</mark>",
                html: 'Die Formel für G ist:<br><mark>G = 100% × W ÷ p</mark><br><mark>W</mark> ist hier der Prozentwert, also der Wert wie viel p% wert sind bzw. der Wert der prozentualen Veränderung von G.' +
                    '<br><mark>p</mark> ist der Prozentsatz, dieser ist immer in der Einheit % und gibt die prozentuale Veränderung für W von G an.',
                icon: "question"
            });
        }
        function p() {
            Swal.fire({
                title: "Formel für <mark>p</mark>",
                html: 'Die Formel für p ist:<br><mark>p% = 100% × W ÷ G</mark><br><mark>W</mark> ist hier der Prozentwert, also der Wert wie viel p% wert sind bzw. der Wert der prozentualen Veränderung von G.' +
                    '<br><mark>p</mark> ist der Prozentsatz, dieser ist immer in der Einheit % und gibt die prozentuale Veränderung für W von G an.',
                icon: "question"
            });
        }
    </script>

</main>


<?php include "../../util/basicFooter.php"; ?>
</body>

</html>