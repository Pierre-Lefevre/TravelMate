$(function () {

    function scrollSmooth(height) {
        this.stop().animate({
            scrollTop: height
        }, 1000);
    }

    function getNewMessage($dateMin) {
        $dateMax = Date.now();
        $.ajax({
            url: $("#new-message").attr("data-path"),
            type: 'POST',
            dataType: 'json',
            data: {
                dateMin: $dateMin,
                dateMax: $dateMax
            },
            success: function (resultat, statut) {
                for (i = 0; i < resultat.messages.length; i++) {
                    $("#list-message").append('<li ' + (resultat.messages[i].me ? 'class="me"' : '') + '>' +
                        '<div class="profile-picture" style="background-image: url(' + resultat.messages[i].profilePicture + ')"></div>' +
                        '<div class="content">' +
                        '<p>' + resultat.messages[i].content + '</p>' +
                        '</div>' +
                        '</li>');
                }
                if (resultat.messages.length > 0) {
                    scrollSmooth.call($overflowElement, $overflowElement[0].scrollHeight);
                }
            },
            error: function (resultat, statut, erreur) {
            },
            complete: function (resultat, statut) {
            }
        });
    }

    var $dateMin;
    var $dateMax;

    $dateMin = Date.now();

    setInterval(function () {
        getNewMessage($dateMin);
        $dateMin = $dateMax;
    }, 5000);

    var $overflowElement = $("#list-message-container");
    $overflowElement.scrollTop($overflowElement[0].scrollHeight);

    $("#send-message-form").submit(function (e) {
        e.preventDefault();

        var $this          = $(this);
        var $formSerialize = $this.serialize();

        $.ajax({
            url: $this.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: $formSerialize,
            success: function (resultat, statut) {
                var $message = $this.find("textarea").val();
                $("#list-message").append('<li class="me">' +
                    '<div class="profile-picture" style="background-image: url(' + $("#my-profile-picture").attr("data-path") + ')"></div>' +
                    '<div class="content">' +
                    '<p>' + $message + '</p>' +
                    '</div>' +
                    '</li>');
                $this.find("textarea").val('');
                scrollSmooth.call($overflowElement, $overflowElement[0].scrollHeight);
            },
            error: function (resultat, statut, erreur) {
            },
            complete: function (resultat, statut) {
            }
        });
    });
});