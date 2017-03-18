document.addEventListener("DOMContentLoaded", function () {
    var openButton = document.querySelectorAll(".open-modal-button");
    for (var i = 0; i < openButton.length; i++) {
        (function () {
            var modal       = document.querySelector(".modal[data-modal='" + openButton[i].getAttribute("data-modal") + "']");
            var closeButton = document.querySelector(".close-modal-button[data-modal='" + openButton[i].getAttribute("data-modal") + "']");
            openButton[i].addEventListener("click", function () {
                modal.style.display = "flex";
            });
            closeButton.addEventListener("click", function () {
                modal.style.display = "none";
            });
            window.addEventListener("click", function (e) {
                if (e.target === modal) {
                    modal.style.display = "none";
                }
            });
        }());
    }
});