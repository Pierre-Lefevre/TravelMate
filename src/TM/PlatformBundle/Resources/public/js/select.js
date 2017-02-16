document.addEventListener("DOMContentLoaded", function () {
	var select = document.querySelectorAll(".form-search select");
	for (var i = 0; i < select.length; i++) {
		if (select[i].value === '') {
			select[i].style.color = '#919191';
		}
		select[i].addEventListener("change", function () {
			if (this.value !== '') {
				this.style.color = '#000000';
			} else {
				this.style.color = '#919191';
			}
		})
	}
});