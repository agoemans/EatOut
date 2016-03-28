var map;
var myLatLng = {lat: 52.3837955, lng: 4.9130078};

function initMap() {
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {lat: 52.3837955, lng: 4.9130078},
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
    });

}

initMap();

