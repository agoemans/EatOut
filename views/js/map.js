var map;
var myLatLng = {lat: 52.3837955, lng: 4.9130078};
var resultsList = [];

function initMap() {
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {lat: 52.3837955, lng: 4.9130078},
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

}

function updateMap() {
    initMap();
    cleanAPIData.getDataFromServer(cleanAPIData.getStreetNames, cleanAPIData);

    console.log(resultsList[0]);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
    });

}

updateMap()