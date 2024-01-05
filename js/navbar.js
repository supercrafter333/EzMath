const toggle = document.getElementsByClassName("nav-toggle")[0]
const content = document.getElementsByClassName("nav-content")[0]

toggle.addEventListener("click", () => {
    var display = content.style.display;
    console.log(display);
    var con = document.querySelector(".nav-content");

    if (display === "flex") {

        con.classList.add('animate__fadeOutUpBig');
        con.addEventListener('animationend', () => {
            con.classList.remove("animate__fadeOutUpBig");
            content.style.display = "none";
        });
    } else {
        content.style.display = "flex";

        con.classList.add('animate__fadeInDownBig', 'animate__faster');
        con.addEventListener('animationend', () => {
            con.classList.remove("animate__fadeInDownBig", "animate__faster");
            content.style.display = "flex";
        });
    }
})