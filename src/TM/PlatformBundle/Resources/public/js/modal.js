document.addEventListener("DOMContentLoaded", function () {
	var modal       = document.querySelector(".modal");
	var openButton  = document.querySelector("#open-modal-button");
	var closeButton = document.querySelector("#close-modal-button");
	openButton.addEventListener("click", function () {
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
});