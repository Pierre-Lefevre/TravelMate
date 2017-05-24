$(function () {

    function scrollSmooth(height) {
        this.stop().animate({
            scrollTop: height
        }, 1000);
    }

    function getNewMessage(dateMin) {
        dateMax = Date.now();
        $.ajax({
            url: $("#new-message").attr("data-path"),
            type: 'POST',
            dataType: 'json',
            data: {
                dateMin: dateMin,
                dateMax: dateMax
            },
            success: function (resultat, statut) {
                for (i = 0; i < resultat.messages.length; i++) {
                    $("#list-message").append('<li ' + (resultat.messages[i].me ? 'class="me"' : '') + '>' +
                        '<div class="profile-picture" style="background-image: url(' + resultat.messages[i].profilePicture + ')"></div>' +
                        '<p>' + resultat.messages[i].content + '</p>' +
                        '</li>');
                }
                if (resultat.messages.length > 0) {
                    scrollSmooth.call(overflowElement, overflowElement[0].scrollHeight);
                }
            },
            error: function (resultat, statut, erreur) {
            },
            complete: function (resultat, statut) {
            }
        });
    }

    var overflowElement = $("#list-message-container");
    var dateMin;
    var dateMax;
    dateMin = Date.now();

    if (overflowElement[0] !== null) {
        setInterval(function () {
            getNewMessage(dateMin);
            dateMin = dateMax;
        }, 5000);
    }

    $("#send-message-form").submit(function (e) {
        e.preventDefault();

        var that          = $(this);
        var formSerialize = that.serialize();

        $.ajax({
            url: that.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: formSerialize,
            success: function (resultat, statut) {
                var message = that.find("textarea").val();
                $("#list-message").append('<li class="me">' +
                    '<div class="profile-picture" style="background-image: url(' + $("#my-profile-picture").attr("data-path") + ')"></div>' +
                    '<p>' + message + '</p>' +
                    '</li>');
                that.find("textarea").val('');
                that.find("input[type='submit']").blur();
                if (that.find("input[type='submit']").val() === "Envoyer") {
                    that.find("input[type='submit']").val("Répondre");
                }
                scrollSmooth.call(overflowElement, overflowElement[0].scrollHeight);
            },
            error: function (resultat, statut, erreur) {
            },
            complete: function (resultat, statut) {
            }
        });
    });
});