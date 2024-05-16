<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <?php
    include "../../util/basicHeader.php";
    $header = new basicHeader(__DIR__, "Grundwert (G) berechnen", ["exponential", "growth", "exponent", "exponentiel", "wachstum", "exponentielles wachstum", "abnahme", "zinsrechnung", "k0", "kn", "p", "prozentsatz"]);

    echo $header->__toString();
    $res = "";
    ?>
</head>

<body>

<?php
include "../../util/basicNav.php";
echo (new basicNav("PercentageCoreValue.php"));
?>

<br />

<div class="skewedTop">
    <h1>Prozentrechnung</h1>
    <h3>Grundwert (G)</h3>
</div>

<main>

    <form action="#" method="post" onsubmit="startLoader()">

        <?php

        if (!isset($_POST["W"]) || !isset($_POST["Prozent"]) || !isset($_POST["Gprozent"]) || !isset($_POST["Nachkommastellen"])) {
            echo implode(PHP_EOL, [
                '<label for="W">Prozentwert (W):</label>',
                '<input type="number" step="any" value="125" alt="W" name="W" required>',
                '',
                '<label for="Prozent">Prozentsatz (p):</label>',
                '<input type="number" step="any" value="25" alt="Prozent" name="Prozent" required contenteditable="true">',
                '',
                '<label for="Gprozent">Grundprozentsatz (100%):</label>',
                '<input type="number" step="any" value="100" alt="Gprozent" name="Gprozent" required>',
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
            include "../../calcOps/Percentage/PercentageCoreValue.php";
            $W = htmlspecialchars($_POST["W"]);
            $p = htmlspecialchars($_POST["Prozent"]);
            $Gprozent = htmlspecialchars($_POST["Gprozent"] ?? 100);
            $dp = htmlspecialchars($_POST["Nachkommastellen"]);

            $calc = new PercentageCoreValue($W, $p, $Gprozent);
            $res = $calc->calc($dp);


            echo implode(PHP_EOL, [
                '<label for="W">Prozentwert (W):</label>',
                '<input type="number" step="any" value="' . $W . '" alt="W" name="W" required>',
                '',
                '<label for="Prozent">Prozentsatz (p):</label>',
                '<input type="number" step="any" value="' . $p . '" alt="Prozent" name="Prozent" required contenteditable="true">',
                '',
                '<label for="Gprozent">Grundprozentsatz (100%):</label>',
                '<input type="number" step="any" value="' . $Gprozent . '" alt="Gprozent" name="Gprozent" required>',
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
                '<progress id="loader" style="display: none;"></progress>'
            ]);
        }
        ?>

    </form>

    <div id="result">
        <?php
        if ($res !== "") {
            include "../../util/resultArticle.php";
            echo(new resultArticle($res, "Grundwert (G)"));
        }
        ?>
    </div>

    <br />

    <button id="formula" class="contrast outline formula-btn formula-btn-reg" onclick="formula()">Formel ansehen</button>

    <script>

        function formula() {
            Swal.fire({
                title: "Formel für <mark>G</mark>",
                html: 'Die Formel für G ist:<br><mark>G = 100% × W ÷ p</mark><br><mark>W</mark> ist hier der Prozentwert, also der Wert wie viel p% wert sind bzw. der Wert der prozentualen Veränderung von G.' +
                    '<br><mark>p</mark> ist der Prozentsatz, dieser ist immer in der Einheit % und gibt die prozentuale Veränderung für W von G an.',
                icon: "question"
            });
        }
    </script>

</main>

<?php include "../../util/basicFooter.php"; ?>

</body>

</html>