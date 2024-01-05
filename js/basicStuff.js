/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */

function submittedBtn() {
    var loader = $("loader");
    loader.style.display = "block";
    var load = doc.getElementById("loader");
    load.style.display = "block";
}

function activateLoader() {
    var loader = document.getElementById("loader");

    loader.style.display = "block";
}

function copyResult(elementCount) {
    var result = document.getElementsByClassName('result')[elementCount];

    navigator.clipboard.writeText(result.textContent);

    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Ergebnis in Zwischenablage kopiert!",
        showConfirmButton: false,
        timer: 1500
    });
}