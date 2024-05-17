<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <?php
    include "../../util/basicHeader.php";
    $header = new basicHeader(__DIR__, "Prozent (p) berechnen", ["exponential", "growth", "exponent", "exponentiel", "wachstum", "exponentielles wachstum", "abnahme", "zinsrechnung", "k0", "kn", "p", "prozentsatz"]);

    echo $header->__toString();
    $res = "";
    ?>
</head>

<body>

<?php
include "../../util/basicNav.php";
echo (new basicNav("PercentagePercentage.php"));
?>

<br />

<div class="skewedTop">
    <h1>Prozentrechnung</h1>
    <h3>Prozent (p)</h3>
</div>

<main>

    <form action="#" method="post" onsubmit="startLoader()">

        <?php

        if (!isset($_POST["G"]) || !isset($_POST["W"]) || !isset($_POST["Gprozent"]) || !isset($_POST["Nachkommastellen"])) {
            echo implode(PHP_EOL, [
                '<label for="G">Grundwert (G):</label>',
                '<input type="number" step="any" value="500" alt="G" name="G" required>',
                '',
                '<label for="W">Prozentwert (W):</label>',
                '<input type="number" step="any" value="125" alt="W" name="W" required contenteditable="true">',
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
            include "../../calcOps/Percentage/PercentagePercentage.php";
            $G = htmlspecialchars($_POST["G"]);
            $W = htmlspecialchars($_POST["W"]);
            $Gprozent = htmlspecialchars($_POST["Gprozent"] ?? 100);
            $dp = htmlspecialchars($_POST["Nachkommastellen"]);

            $calc = new PercentagePercentage($G, $W, $Gprozent);
            $res = $calc->calc($dp);


            echo implode(PHP_EOL, [
                '<label for="W">Grundwert (G):</label>',
                '<input type="number" step="any" value="' . $G . '" alt="G" name="G" required>',
                '',
                '<label for="Prozent">Prozentwert (W):</label>',
                '<input type="number" step="any" value="' . $W . '" alt="W" name="W" required contenteditable="true">',
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
            echo(new resultArticle($res, "Prozent (p)", 0, '%'));
        }
        ?>
    </div>

    <br />

    <button id="formula" class="contrast outline formula-btn formula-btn-reg" onclick="formula()">Formel ansehen</button>

    <script>

        function formula() {
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