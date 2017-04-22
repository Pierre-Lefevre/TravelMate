document.addEventListener("DOMContentLoaded", function () {
    var nav          = document.querySelector("nav");
    var ul           = nav.querySelector("ul");
    var burgerButton = ul.querySelector("li:last-child a");

    burgerButton.addEventListener("click", function (e) {
        e.preventDefault();
        ul.classList.contains("responsive") ? ul.classList.remove("responsive") : ul.classList.add("responsive");
    });

    window.addEventListener("resize", function () {
        if (document.documentElement.clientWidth > 780) {
            if (ul.classList.contains("responsive")) {
                ul.classList.remove("responsive");
            }
        }
    });
});