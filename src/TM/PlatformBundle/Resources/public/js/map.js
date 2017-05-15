var map;
var infowindow;
var markers      = [];
var frenchLatLng = {lat: 46.227638, lng: 2.213749};

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: frenchLatLng,
        zoom: 3,
        mapTypeControl: false,
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: google.maps.ControlPosition.LEFT_BOTTOM
        }
    });

    infowindow = new google.maps.InfoWindow();

    ajaxCountryCodes();

    google.maps.event.addListener(infowindow, 'domready', function () {
        document.querySelector('.gm-style-iw').parentNode.classList.add('custom-iw');
    });
}

function ajaxCountryCodes() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', Routing.generate('tm_platform_ajax_country_codes'));
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.responseType = 'json';
    xhr.onload       = function (e) {
        initMarkers(e.target.response.code);
    };
    xhr.send();
}

function initMarkers(countCountryCodes) {
    for (var key in countCountryCodes) {
        markers[key] = new google.maps.Marker({
            map: map,
            position: {lat: countCountryCodes[key]["lat"], lng: countCountryCodes[key]["lng"]},
            code: key
        });
        markers[key].addListener('click', clickMarker.bind(markers[key]));
    }
}

function clickMarker() {
    var marker = this;
    var xhr    = new XMLHttpRequest();
    xhr.open('POST', Routing.generate('tm_platform_ajax_last_travel', {
        'code': marker.code
    }));
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.responseType = 'document';
    xhr.onload       = function (e) {
        infowindow.setContent(e.target.response.documentElement.innerHTML);
        infowindow.open(map, marker);
    };
    xhr.send();
}