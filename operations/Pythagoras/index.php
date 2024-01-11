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
        <h1>Satz des Pythagoras</h1>
        <h3><mark>a<sup>2</sup> + b<sup>2</sup> = c<sup>2</sup></mark></h3>
        <p>Der Satz des Pythagoras wird benutzt um eine fehlende Seite eines rechtwinkligen Dreiecks zu berechnen. Dabei sind zwei Katheten und eine Hypotenuse vorhanden. Möchte man die Hypotenuse ausrechnen, wird addition verwenden <mark>Kathete<sup>2</sup> + Kathete<sup>2</sup> = Hypotenuse<sup>2</sup></mark>. Möchte man eine der beiden Katheten ausrechnen verwendet man subtraktion, also <mark>Hypotenuse<sup>2</sup> - Kathete<sup>2</sup> = Kathete<sup>2</sup></mark>.</p>
    </div>

    <article class="basicArticle">
        <h3>Hypotenuse berechnen</h3>
        <br />
        <a role="button" href="#" disabled="true">Zum Rechner</a>
        <a role="button" href="#" onclick="Hyp()" class="contrast outline formula-btn">Formel</a>
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