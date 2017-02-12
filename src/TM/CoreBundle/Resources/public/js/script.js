document.addEventListener("DOMContentLoaded", function () {
	var header = document.querySelector("body > header");
	var nav = document.querySelector("body > nav");
	var homeImg = document.querySelector("#home-img");
	homeImg.style.height = "calc(100vh - " + (header.offsetHeight + nav.offsetHeight) + "px)";
});