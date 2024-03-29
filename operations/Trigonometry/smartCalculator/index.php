<?php
/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */

include "ComplexSmartCalculator.php";
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

foreach ($_POST as $item => $value)
    $_POST[$item] = htmlspecialchars($value);

$alpha = $_POST["alpha"] ?? 0;
$beta = $_POST["beta"] ?? 0;
$gamma = $_POST["gamma"] ?? 90;
$a = $_POST["a"] ?? 0;
$b = $_POST["b"] ?? 0;
$c = $_POST["c"] ?? 0;
$kommastellen = $_POST["Nachkommastellen"] ?? null;
$results = false;
?>

<br>

<main style="margin: auto;">

    <div class="headline">
        <h1>Trigonometrie</h1>
        <h3><mark>Der schlaue Rechner</mark></h3>
    </div>

    <div class="single-label-container">
        <p class="label-warning">BETA-Funktion</p>
    </div>

    <div class="bigView">

        <div class="slideshow-container">

            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="../../../media/img/right_triangle_with_angles.png" style="width:98%">
                <div class="text">Rechter Winkel bei Gamma (γ)</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="../../../media/img/right_triangle_with_angles_alpha.png" style="width:98%">
                <div class="text">Rechter Winkel bei Alpha (α)</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="../../../media/img/right_triangle_with_angles_beta.png" style="width:98%">
                <div class="text">Rechter Winkel bei Beta (β)</div>
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <!--<div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>-->

    <script>
        let slideIndex = <?php if ($gamma == 90) echo 1; elseif ($alpha == 90) echo 2; elseif ($beta == 90) echo 3; else echo 1; ?>;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            /*var gamma = document.getElementById("gamma");
            var alpha = document.getElementById("alpha");
            var beta = document.getElementById("beta");*/
        }
    </script>

        <!--<img src="../../../media/img/right_triangle_with_angles.png" alt="Bild eines Dreickes mit Winkeln- und Seitenbeschreibungen">-->
    </div>

    <br>

    <?php
    if (isset($_POST["searchedVal"])) {
        if (isset($_POST["alpha"]) || isset($_POST["beta"]))
            $results = ComplexSmartCalculator::getResult($_POST["searchedVal"], ["alpha" => $alpha, "beta" => $beta, "gamma" => $gamma], ["a" => $a, "b" => $b, "c" => $c]);
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

    if ($results instanceof SmartResult) {
        $matchSearchedType = match ($results->getSearchedValue()) {
            "a", "b", "c" => "Seite",
            "alpha", "beta", "gamma" => "Winkel"
        };
        $resArticle = new complexResultArticle($results->getSearchedValue(), $results->getGivenValues(), $results->getOperationMethod(), $results->getResult(), $matchSearchedType . " " . $results->getSearchedValue(), 0, $matchSearchedType === "Winkel" ? '°' : null, $results->getCalcWay());
        echo $resArticle->__toString() . "<br>";
    }
    ?>
    <form action="index.php" onsubmit="startLoader()" method="post">
        <article>
            <header>
                <h4>Trage die gegeben Werte ein und wähle den gesuchten Wert aus</h4>
            </header>

            <h4>Gesuchter Wert:</h4>

            <label for="searchedVal"></label>
            <select name="searchedVal"  required>
                <option value="alpha">Alpha (α)</option>
                <option value="beta">Beta (β)</option>
                <option value="gamma">Gamma (γ)</option>
                <option value="a">Seite a</option>
                <option value="b">Seite b</option>
                <option value="c">Seite c</option>
            </select>

            <br />
            <br />

            <h4>Gegebene Werte:</h4>

            <div class="grid" data-tooltip="Ein Winkel muss 90° haben!">
                <span>
                    <label for="alpha">Winkel Alpha (α):</label>
                    <input type="number" step="any" name="alpha" id="alpha"  value="<?php echo $alpha; ?>">
                </span>
                <span>
                    <label for="beta">Winkel Beta (β):</label>
                    <input type="number" step="any" name="beta" id="beta" value="<?php echo $beta; ?>">
                </span>

                <span>
                    <label for="gamma">Winkel Gamma (γ):</label>
                    <input type="number" step="any" name="gamma" id="gamma" value="<?php echo ($gamma !== null && $gamma !== 0) ? $gamma : 90; ?>">
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
                <?php
                for ($i = 0; $i <= 8; $i++) {
                    $numberText = $i === 0 ? "Volle Zahl" : $i . " Nachkommastellen";
                    if ($i === 2 && ($kommastellen === null || $kommastellen < 0 || $kommastellen > 8))
                        echo '<option value="' . $i . '" selected>' . $numberText . '</option>';
                    elseif ($i === (int)$kommastellen)
                        echo '<option value="' . $i . '" selected>' . $numberText . '</option>';
                    else
                        echo '<option value="' . $i . '">' . $numberText . '</option>';
                }
                ?>
            </select>

            <footer>
                <button type="submit" id="submitForm">Berechnen</button>
            </footer>
        </article>
    </form>

    <script>
        function startLoader() {
            var loader = document.getElementById("submitForm");
            loader.setAttribute("aria-busy", "true");
            loader.textContent = "";
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