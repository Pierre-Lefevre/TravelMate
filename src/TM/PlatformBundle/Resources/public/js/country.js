function addFlags() {
    var country    = ["HR", "TW", "MS", "CZ", "VC", "AD", "EH", "HK", "GA", "CATALONIA", "SOMALILAND", "MU", "KZ", "PW", "AN", "BG", "NF", "GS", "MM", "TM", "DM", "SM", "OM", "CK", "YT", "RW", "SG", "AL", "EC", "ET", "BM", "GM", "AW", "IT", "BR", "KG", "SB", "EE", "AO", "TR", "BN", "GU", "TK", "BS", "FR", "LY", "MK", "PY", "ST", "PN", "PH", "BB", "TN", "SK", "ID", "MP", "NC", "WS", "FK", "KP", "EG", "SN", "TIBET", "KY", "IM", "NO", "MZ", "KW", "AG", "SR", "EU", "JE", "PE", "BT", "SC", "NG", "JO", "GD", "CD", "SO", "DE", "VA", "SL", "PA", "IQ", "IE", "GW", "VG", "TZ", "MX", "UM", "CV", "AS", "DJ", "MN", "ZANZIBAR", "DO", "MY", "AT", "ML", "CA", "BH", "RU", "CF", "HM", "AZ", "MA", "PM", "CU", "PT", "BD", "TL", "ENGLAND", "TO", "DK", "NA", "CO", "GY", "KURDISTAN", "MH", "QA", "PF", "DZ", "LI", "FJ", "VU", "LB", "MQ", "GE", "AI", "BV", "MR", "MC", "LK", "BJ", "FM", "XK", "GR", "TG", "ZM", "CY", "PR", "AF", "GF", "IS", "MD", "KR", "GP", "IL", "RO", "ZA", "CN", "MV", "LS", "GT", "SS", "BO", "TD", "TH", "HU", "ER", "TC", "SD", "HN", "MG", "PL", "WALES", "AM", "BE", "KE", "AR", "NI", "HT", "IO", "GH", "NU", "MT", "KH", "CG", "CL", "VN", "SCOTLAND", "FI", "RE", "NP", "BA", "LT", "WF", "MO", "GN", "SZ", "TT", "ES", "UZ", "CH", "PG", "LU", "SA", "IR", "UG", "US", "VI", "SX", "YE", "NZ", "JP", "GQ", "PK", "BF", "SY", "CR", "TF", "SV", "PS", "AU", "LA", "MW", "NL", "GB", "NR", "GL", "RS", "CM", "GI", "KM", "TV", "ME", "CW", "GG", "JM", "AE", "SI", "TJ", "BZ", "VE", "IN", "SH", "KI", "ZW", "IC", "BY", "FO", "NE", "UY", "LR", "CI", "LC", "SE", "KN", "LV", "BW", "UA"];
    var notCountry = ["EZ", "UN"];
    var elements    = document.querySelectorAll(".form-add-edit .second-column select:nth-of-type(2) option, #travel_search_countries option, .countries > ul > li");

    for (var i = 0; i < elements.length; i++) {

        var code = elements[i].hasAttribute("data-code") ? elements[i].getAttribute("data-code") : elements[i].value;

        if (notCountry.indexOf(code) !== -1) {
            elements[i].remove();
            continue;
        }

        var div = document.createElement("div");

        if (country.indexOf(code.toUpperCase()) !== -1) {
            div.classList.add("flag");
            div.classList.add("flag-" + code.toLowerCase());
            elements[i].insertBefore(div, elements[i].firstChild);
            continue;
        }

        if (!elements[i].hasAttribute("data-flag-not-empty")) {
            div.classList.add("empty-flag");
            elements[i].insertBefore(div, elements[i].firstChild);
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    addFlags();
});