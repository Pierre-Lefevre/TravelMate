document.addEventListener("DOMContentLoaded", function () {
    var edit = document.querySelectorAll(".edit");
    for (var i = 0; i < edit.length; i++) {
        (function () {
            var content = edit[i].closest(".content");
            edit[i].addEventListener("click", function () {
                content.querySelector("p").style.display                  = "none";
                content.querySelector(".action").style.display            = "none";
                content.querySelector(".form-edit-comment").style.display = "flex";
            })
        }());
    }
});