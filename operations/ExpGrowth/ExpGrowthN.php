<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <?php
    include "../../util/basicHeader.php";
    $header = new basicHeader(__DIR__, "Exponentielles Wachstum (Wiederholungen - n)", ["exponential", "growth", "exponent", "exponentiel", "wachstum", "exponentielles wachstum", "abnahme", "zinsrechnung", "k0", "kn", "p", "prozentsatz"]);

    echo $header->__toString();
    $res = "";
    ?>
</head>

<body>

<?php
include "../../util/basicNav.php";
echo (new basicNav("ExpGrowthN.php"));
?>

<br />

<div class="skewedTop">
    <h1>Exponentielles Wachstum</h1>
    <h3>Wiederholungen - n</h3>
</div>

<main>

    <form action="#" method="post" onsubmit="activateLoader()">

        <?php

        if (!isset($_POST["K0"]) || !isset($_POST["Kn"]) || !isset($_POST["p"]) || !isset($_POST["Nachkommastellen"])) {
            echo implode(PHP_EOL, [
                '<label for="K0">Startwert (K0):</label>',
                '<input type="number" step="any" value="0" alt="K0" name="K0" required>',
                '',
                '<label for="Kn">Endwert (Kn):</label>',
                '<input type="number" step="any" value="0" alt="Kn" name="Kn" required>',
                '',
                '<label for="p">Prozentsatz (p):</label>',
                '<input type="number" step="any" value="0" alt="p" name="p" required>',
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
            include "../../calcOps/ExpGrowth/ExpGrowthN.php";
            $k0 = htmlspecialchars($_POST["K0"]);
            $kn = htmlspecialchars($_POST["Kn"]);
            $p = htmlspecialchars($_POST["p"]);
            $dp = htmlspecialchars($_POST["Nachkommastellen"]);

            $calc = new ExpGrowthN($k0, $kn, $p);
            $res = $calc->calc($dp);

            //echo "<script>Swal.fire({title: 'Ergebnis:', text: $res, icon: 'success'})</script>";


            echo implode(PHP_EOL, [
                '<label for="K0">Startwert (K0):</label>',
                '<input type="number" step="any" value="' . $k0 . '" alt="K0" name="K0" required>',
                '',
                '<label for="Kn">Endwert (Kn):</label>',
                '<input type="number" step="any" value="' . $kn . '" alt="Kn" name="Kn" required>',
                '',
                '<label for="p">Prozentsatz (p):</label>',
                '<input type="number" step="any" value="' . $p . '" alt="p" name="p" required>',
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
            echo (new resultArticle($res));
        }
        ?>
    </div>

</main>

<?php include "../../util/basicFooter.php"; ?>

</body>

</html>