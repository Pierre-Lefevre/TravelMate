document.addEventListener("DOMContentLoaded", function () {
	var options = document.querySelectorAll
	("#travel_countries option");
	for (var i = 0; i < options.length; i++){
		var div = document.createElement("div");
		div.classList.add("flag");
		div.classList.add("flag-" + options[i].value.toLowerCase());
		options[i].insertBefore(div, options[i].firstChild);
	}
});