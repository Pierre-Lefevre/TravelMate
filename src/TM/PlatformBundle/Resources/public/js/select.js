document.addEventListener("DOMContentLoaded", function () {
    var selects = document.querySelectorAll("select");
    for (var i = 0; i < selects.length; i++) {
        if (selects[i].value === '') {
            selects[i].style.color = '#919191';
        } else {
            selects[i].style.color = '#000000';
        }
        selects[i].addEventListener("change", function () {
            if (this.value !== '') {
                this.style.color = '#000000';
            } else {
                this.style.color = '#919191';
            }
        })
    }
});