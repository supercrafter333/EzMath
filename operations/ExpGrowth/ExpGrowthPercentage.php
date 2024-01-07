<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <?php
    include "../../util/basicHeader.php";
    $header = new basicHeader(__DIR__, "Exponentielles Wachstum (Prozentsatz - q & p)", ["exponential", "growth", "exponent", "exponentiel", "wachstum", "exponentielles wachstum", "abnahme", "zinsrechnung", "k0", "kn", "p", "prozentsatz"]);

    echo $header->__toString();
    $resQ = "";
    $resP = "";
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
    <h3>Prozentsatz - q & p</h3>
</div>

<main>

    <form action="#" method="post" onsubmit="activateLoader()">

        <?php

        if (!isset($_POST["K0"]) || !isset($_POST["Kn"]) || !isset($_POST["Jahre"]) || !isset($_POST["Nachkommastellen"])) {
            echo implode(PHP_EOL, [
                '<label for="K0">Startwert (K0):</label>',
                '<input type="number" step="any" value="0" alt="K0" name="K0" required>',
                '',
                '<label for="Kn">Endwert (Kn):</label>',
                '<input type="number" step="any" value="0" alt="Kn" name="Kn" required>',
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
            include "../../calcOps/ExpGrowthQP.php";
            $k0 = htmlspecialchars($_POST["K0"]);
            $kn = htmlspecialchars($_POST["Kn"]);
            $n = htmlspecialchars($_POST["Jahre"]);
            $dp = htmlspecialchars($_POST["Nachkommastellen"]);

            $calc = new ExpGrowthQP($k0, $kn, $n);
            $res = $calc->calc($dp);
            $resQ = htmlspecialchars($res["q"]);
            $resP = htmlspecialchars($res["p"]);

            //echo "<script>Swal.fire({title: 'Ergebnis:', text: $res, icon: 'success'})</script>";


            echo implode(PHP_EOL, [
                '<label for="K0">Startwert (K0):</label>',
                '<input type="number" step="any" value="' . $k0 . '" alt="K0" name="K0" required>',
                '',
                '<label for="Kn">Endwert (Kn):</label>',
                '<input type="number" step="any" value="' . $kn . '" alt="Kn" name="Kn" required>',
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
    if ($resQ !== "" && $resP !== "") {
        include "../../util/resultArticle.php";
        echo (new resultArticle($resQ, "Prozentsatz (q)", 0));
        echo "<br>";
        echo (new resultArticle($resP, "Prozent (p)", 1, '%'));
    }
    ?>
    </div>

</main>

<?php include "../../util/basicFooter.php"; ?>

</body>

</html>