var map;
var myLatLng = {lat: 52.3837955, lng: 4.9130078};
var markerGroup = [];

function initMap() {
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {lat: 52.3837955, lng: 4.9130078},
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    google.maps.event.addListener(map, 'idle', showMarkers);
}

function updateMap() {
    initMap();
    //cleanAPIData.getDataFromServer(cleanAPIData.getStreetNames, cleanAPIData);

    dataProcessor = new dataProcessor(this.gotData, this);

    dataProcessor.fetchData();

}

function gotData(data) {
    //var markerGroup = [];
    var res = cleanAPIData.getStreetNames(data);

    console.log(res.length % 10);
    createMarkers(res);


    //return markerPositionList;
    setMarkerOnMap(markerGroup);

    var mapPrcssr = new mapProcessor();

    mapPrcssr.getDataFromDB();
    console.log(mapPrcssr.markerList);
}

function createMarkers(arr){

    if (arr < 10){
        counter = arr.length
    } else {
        counter = 10;
    }
    for(var i=0; i < 4; i++){
        console.log(i, arr[4])
        var markerPos = {lat: parseFloat(arr[i].lat), lng: parseFloat(arr[i].lng)};
        var marker = new google.maps.Marker({
            position: markerPos,
            map: map,
            title: arr[i].placename
        });
        markerGroup.push(marker);
    }
}


function setMarkerOnMap(data){
    var markerHolder = data;

    for(var i=0; i < 5; i++){
        var location = markerHolder[i];
        window.setTimeout(function(myMap){
            return function (){ myMap.setMap(map);}
        } (location), i * 200);
    }

}

function showMarkers() {
    var testLatLng = {lat: 52.378010, lng: 4.895868};
    var bounds = map.getBounds();
    var ne = bounds.getNorthEast();
    var sw = bounds.getSouthWest();
    //console.log(bounds, ne, sw)


    // Call you server with ajax passing it the bounds

    // In the ajax callback delete the current markers and add new markers
}

updateMap();