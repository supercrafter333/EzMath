<?php
/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */

include "SmartCalculator.php";
include "../../../util/complexResultArticle.php";
?>

<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <?php
    include "../../../util/basicHeader.php";
    $header = new basicHeader(__DIR__, "Trigonometrie (Schlauer Rechner)", ["mathematik", "rechnen", "taschenrechner", "rechner", "exponentiell", "bruch", "exponent", "wurzel", "potenz", "mathe", "ez", "math"]);

    echo $header->__toString();
    ?>
</head>

<body>

<?php
include "../../../util/basicNav.php";
echo (new basicNav());
?>

<br>

<main style="margin-top: 0;">

    <div class="headline">
        <h1>Trigonometrie</h1>
        <h3><mark>Der schlaue Rechner</mark></h3>
    </div>

    <div class="single-label-container">
        <p class="label-warning">BETA-Funktion</p>
    </div>

    <div class="bigView">
        <img src="../../../media/img/right_triangle_with_angles.png" alt="Bild eines Dreickes mit Winkeln- und Seitenbeschreibungen">
    </div>

    <br>

    <?php
    foreach ($_POST as $item => $value)
        $_POST[$item] = htmlspecialchars($value);

    $alpha = $_POST["alpha"] ?? 0;
    $beta = $_POST["beta"] ?? 0;
    $a = $_POST["a"] ?? 0;
    $b = $_POST["b"] ?? 0;
    $c = $_POST["c"] ?? 0;
    $results = false;

    if (isset($_POST["searchedVal"])) {
        if (isset($_POST["alpha"]) || isset($_POST["beta"]))
            $results = SmartCalculator::getResult($_POST["searchedVal"], array_filter(["alpha" => $alpha, "beta" => $beta], fn($value) => !is_null($value) && $value !== 0), array_filter(["a" => $a, "b" => $b, "c" => $c], fn($value) => !is_null($value) && $value !== 0));
        if ($results === null) resultError();
    }

    function resultError(): void
    {
        echo '<script>' .
            'Swal.fire({' .
            'title: "Fehler!",' .
            'text: "Du hast zu wenig Werte angegeben! Der gewünschte Wert konnte daher nicht berechnet werden. Bitte versuche es erneut.",' .
            'icon: "error"' .
            '})' .
            '</script>';
    }

    if (is_array($results)) {
        $matchSearchedType = match ($results[0][0]) {
            "a", "b", "c" => "Seite",
            "alpha", "beta" => "Winkel"
        };
        $resArticle = new complexResultArticle($results[0][0], $results[0][1][1], $results[0][1][0], round($results[1], intval($_POST["Nachkommastellen"] ?? 2)), $matchSearchedType . " " . $results[0][0]);
        echo $resArticle->__toString();
    }
    ?>
    <form action="index.php" onsubmit="startLoader()" method="post">
        <article>
            <header>
                <h4>Trage die gegeben Werte ein und wähle den gesuchten Wert aus</h4>
            </header>

            <h4>Gesuchter Wert:</h4>

            <label for="searchedVal"></label>
            <select name="searchedVal" required>
                <option value="alpha">Alpha (α)</option>
                <option value="beta">Beta (β)</option>
                <option value="a">Seite a</option>
                <option value="b">Seite b</option>
                <option value="c">Seite c</option>
            </select>

            <br />
            <br />

            <h4>Gegebene Werte:</h4>

            <div class="grid">
                <span>
                    <label for="alpha">Winkel Alpha (α):</label>
                    <input type="number" step="any" name="alpha" id="alpha"  value="<?php echo $alpha; ?>">
                </span>
                <span>
                    <label for="">Winkel Beta (β):</label>
                    <input type="number" step="any" name="beta" id="beta" value="<?php echo $beta; ?>">
                </span>
            </div>

            <div class="grid">
                <span>
                    <label for="a">Seite a:</label>
                    <input type="number" step="any" name="a" id="a" value="<?php echo $a; ?>">
                </span>
                <span>
                    <label for="b">Seite b:</label>
                    <input type="number" step="any" name="b" id="b" value="<?php echo $b; ?>">
                </span>
                <span>
                    <label for="c">Seite c:</label>
                    <input type="number" step="any" name="c" id="c" value="<?php echo $c; ?>">
                </span>
            </div>

            <label for="Nachkommastellen"><i>Nachkommastellen:</i></label>
            <select name="Nachkommastellen" required>
                <option value="0">Volle Zahl</option>
                <option value="1">1 Nachkommastelle</option>
                <option value="2" selected>2 Nachkommastellen</option>
                <option value="3">3 Nachkommastellen</option>
                <option value="4">4 Nachkommastellen</option>
                <option value="5">5 Nachkommastellen</option>
                <option value="6">6 Nachkommastellen</option>
                <option value="7">7 Nachkommastellen</option>
                <option value="8">8 Nachkommastellen</option>
            </select>

            <footer>
                <input type="submit" value="Berechnen">
                <progress id="submitFormProgressBar" style="display: none;"></progress>
            </footer>
        </article>
    </form>

    <script>
        function startLoader() {
            var loader = document.getElementById("submitFormProgressBar");
            loader.style.display = "block";
        }

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


<?php include "../../../util/basicFooter.php"; ?>
</body>

</html>