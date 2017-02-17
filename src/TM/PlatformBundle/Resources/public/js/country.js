document.addEventListener("DOMContentLoaded", function () {
	var options = document.querySelectorAll
	(".form-add-edit .second-column select:nth-of-type(2) option");
	for (var i = 0; i < options.length; i++){
		var div = document.createElement("div");
		div.classList.add("flag");
		div.classList.add("flag-" + options[i].value.toLowerCase());
		options[i].insertBefore(div, options[i].firstChild);
	}
});