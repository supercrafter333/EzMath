<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
<?php
include "../../util/basicHeader.php";
$header = new basicHeader(__DIR__, "Exponentielles Wachstum (Endwert - Kn)", ["exponential", "growth", "exponent", "exponentiel", "wachstum", "exponentielles wachstum", "abnahme", "zinsrechnung", "k0", "kn", "p", "prozentsatz"]);

echo $header->__toString();
$res = "";
?>
</head>

<body>

<?php
include "../../util/basicNav.php";
echo (new basicNav("ExpGrowthEnd.php"));
?>

<br />

<div class="skewedTop">
    <h1>Exponentielles Wachstum</h1>
    <h3>Endwert - K(n)</h3>
</div>

<main>
    
    <form action="#" method="post" onsubmit="startLoader()">

        <?php

        if (!isset($_POST["K0"]) || !isset($_POST["Prozent"]) || !isset($_POST["Jahre"]) || !isset($_POST["Nachkommastellen"])) {
            echo implode(PHP_EOL, [
                '<label for="K0">Startwert (K0):</label>',
                '<input type="number" step="any" value="0" alt="K0" name="K0" required>',
                '',
                '<label for="Prozent">Prozentsatz (p):</label>',
                '<input type="number" step="any" value="2.5" alt="Prozent" name="Prozent" required contenteditable="true">',
                '',
                '<label for="Jahre">Wiederholungen (n):</label>',
                '<input type="number" step="any" value="2" alt="Jahre" name="Jahre" required>',
                '<br />',
                '<label for="Nachkommastellen"><i>Nachkommastellen:</i></label>',
                '<select name="Nachkommastellen" required>',
                '<option value="0">Volle Zahl</option>',
                '<option value="1">1 Nachkommastelle</option>',
                '<option value="2" selected>2 Nachkommastellen</option>',
                '<option value="3">3 Nachkommastellen</option>',
                '<option value="4">4 Nachkommastellen</option>',
                '<option value="5">5 Nachkommastellen</option>',
                '<option value="6">6 Nachkommastellen</option>',
                '</select>',
                '',
                '<button type="submit" id="submitForm">Berechnen</button>',
            ]);
        } else {
            include "../../calcOps/ExpGrowth/ExpGrowthKn.php";
            $k0 = htmlspecialchars($_POST["K0"]);
            $p = htmlspecialchars($_POST["Prozent"]);
            $n = htmlspecialchars($_POST["Jahre"]);
            $dp = htmlspecialchars($_POST["Nachkommastellen"]);

            $calc = new ExpGrowthKn($k0, $n, $p);
            $res = $calc->calc($dp);

            //echo "<script>Swal.fire({title: 'Ergebnis:', text: $res, icon: 'success'})</script>";


            echo implode(PHP_EOL, [
                '<label for="K0">Startwert (K0):</label>',
                '<input type="number" step="any" value="' . $k0 . '" alt="K0" name="K0" required>',
                '',
                '<label for="Prozent">Prozentsatz (p):</label>',
                '<input type="number" step="any" value="' . $p . '" alt="Prozent" name="Prozent" required>',
                '',
                '<label for="Jahre">Wiederholungen (n):</label>',
                '<input type="number" step="any" value="' . $n . '" alt="Jahre" name="Jahre" required>',
                '<br />',
                '<label for="Nachkommastellen"><i>Nachkommastellen:</i></label>',
                '<select name="Nachkommastellen" required>',
                '<option value="0">Volle Zahl</option>',
                '<option value="1">1 Nachkommastelle</option>',
                '<option value="2" selected>2 Nachkommastellen</option>',
                '<option value="3">3 Nachkommastellen</option>',
                '<option value="4">4 Nachkommastellen</option>',
                '<option value="5">5 Nachkommastellen</option>',
                '<option value="6">6 Nachkommastellen</option>',
                '</select>',
                '',
                '<button type="submit" id="submitForm">Berechnen</button>',
            ]);
        }
        ?>

    </form>

    <div id="result">
    <?php
    if ($res !== "") {
        include "../../util/resultArticle.php";
        echo(new resultArticle($res));
    }
    ?>
    </div>

    <br />

    <button id="formula" class="contrast outline formula-btn formula-btn-reg" onclick="formula()">Formel ansehen</button>

    <script>
        function formula() {
            Swal.fire({
                title: "Formel für <mark>K<sub>n</sub></mark>",
                html: 'Die Formel für K<sub>n</sub> ist:<br><mark>K<sub>n</sub> = K<sub>0</sub> × q<sup>n</sup></mark><br><mark>K<sub>0</sub></mark> ist dabei der Startwert, also der Wert der am Anfang gegeben wurde.<br><mark>q</mark> ist der Prozentsatz, dieser ergibt sich aus <i>p × 100 + 1</i>, wobei p für "Prozent" steht.' +
                    '<br><mark>n</mark> (genutzt in q<sup>n</sup>) ist die Anzahl der Wiederholungen, also wie oft K<sub>0</sub> exponiert werden soll.',
                icon: "question"
            });
        }
    </script>

</main>

<br/>
<br/>

<?php include "../../util/basicFooter.php"; ?>

</body>

</html>