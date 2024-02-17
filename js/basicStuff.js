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

function startLoader() {
    var loader = document.getElementById("submitForm");
    loader.setAttribute("aria-busy", "true");
    loader.textContent = "";
}

function copyResult(elementCount) {
    var result = document.getElementsByClassName('result')[elementCount];

    navigator.clipboard.writeText(result.textContent)
        .then(() => {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Ergebnis in Zwischenablage kopiert!",
                showConfirmButton: false,
                timer: 1500
            });
        })
        .catch(() => {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Ergebnis konnte nicht in Zwischenablage kopiert werden!",
                text: "Bitte nutze einen anderen Browser, z.B. Chrome, Firefox, Opera oder Brave",
                showConfirmButton: false,
                timer: 3000
            });
        });
}