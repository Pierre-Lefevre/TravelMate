function addFlags() {
    var notCountry = ["EZ", "UN"];
    var options    = document.querySelectorAll(".form-add-edit .second-column select:nth-of-type(2) option, #travel_search_countries option, .countries > ul > li");

    for (var i = 0; i < options.length; i++) {

        var code = options[i].hasAttribute("data-code") ? options[i].getAttribute("data-code") : options[i].value;

        if (notCountry.indexOf(code) !== -1) {
            options[i].remove();
            continue;
        }

        if (code.length > 0) {
            var div = document.createElement("div");

            div.classList.add("flag");
            div.classList.add("flag-" + code.toLowerCase());
            if (window.getComputedStyle(div).getPropertyValue("background-position") === "0% 0%") {
                div.classList.remove("flag");
                div.classList.remove("flag-" + code.toLowerCase());
                if (!options[i].hasAttribute("data-flag-not-empty")) {
                    div.classList.add("empty-flag");
                }
            }

            options[i].insertBefore(div, options[i].firstChild);
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    addFlags();
});