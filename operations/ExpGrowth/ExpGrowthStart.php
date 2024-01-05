<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <?php
    include "../../util/basicHeader.php";
    $header = new basicHeader(__DIR__, "Exponentielles Wachstum (Startwert - K0)", ["exponential", "growth", "exponent", "exponentiel", "wachstum", "exponentielles wachstum", "abnahme", "zinsrechnung", "k0", "kn", "p", "prozentsatz"]);

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
    <h3>Startwert - K(0)</h3>
</div>

<main>

    <form action="#" method="post" onsubmit="activateLoader()">

        <?php

        if (!isset($_POST["Kn"]) || !isset($_POST["Prozent"]) || !isset($_POST["Jahre"]) || !isset($_POST["Nachkommastellen"])) {
            echo implode(PHP_EOL, [
                '<label for="Kn">Endkapital (Kn):</label>',
                '<input type="number" step="any" value="0" alt="Kn" name="Kn" required>',
                '',
                '<label for="Prozent">Prozent:</label>',
                '<input type="number" step="any" value="2.5" alt="Prozent" name="Prozent" required contenteditable="true">',
                '',
                '<label for="Jahre">Wiederholungen:</label>',
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
                '<input type="submit" name="submit" value="Berechnen">',
                '<progress id="loader" style="display: none;"></progress>'
            ]);
        } else {
            include "../../calcOps/ExpGrowthK0.php";
            $kn = $_POST["Kn"];
            $p = $_POST["Prozent"];
            $n = $_POST["Jahre"];
            $dp = $_POST["Nachkommastellen"];

            $calc = new ExpGrowthK0($kn, $n, $p);
            $res = $calc->calc($dp);

            //echo "<script>Swal.fire({title: 'Ergebnis:', text: $res, icon: 'success'})</script>";


            echo implode(PHP_EOL, [
                '<label for="Kn">Endkapital (Kn):</label>',
                '<input type="number" step="any" value="' . $kn . '" alt="Kn" name="Kn" required>',
                '',
                '<label for="Prozent">Prozent:</label>',
                '<input type="number" step="any" value="' . $p . '" alt="Prozent" name="Prozent" required>',
                '',
                '<label for="Jahre">Wiederholungen:</label>',
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
                '<input type="submit" name="submit" value="Berechnen">',
                '<progress id="loader" style="display: none;"></progress>'
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

</main>

<?php include "../../util/basicFooter.php"; ?>

</body>

</html>