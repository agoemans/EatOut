var map;
var myLatLng = {lat: 52.3837955, lng: 4.9130078};

function initMap() {
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {lat: 52.3837955, lng: 4.9130078},
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

}

function updateMap() {
    initMap();
    //cleanAPIData.getDataFromServer(cleanAPIData.getStreetNames, cleanAPIData);

    dataProcessor = new dataProcessor(this.gotData, this);

    dataProcessor.fetchData();

}

function gotData(data) {
    var markerPositionList = [];
    var res = cleanAPIData.getStreetNames(data);

    for(var i=0; i < res.length; i++){

        var markerPos = {lat: parseFloat(res[i].lat), lng: parseFloat(res[i].lng)};
        var marker = new google.maps.Marker({
            position: markerPos,
            map: map,
            title: 'Hello World!'
        });
        markerPositionList.push(marker);
    }
    //return markerPositionList;
    setMarkerOnMap(markerPositionList);
}


function setMarkerOnMap(data){
    var markerGroup = data;

    for(var i=0; i < markerGroup.length; i++){
        var location = markerGroup[i];
        window.setTimeout(function(myMap){
            return function (){ myMap.setMap(map);}
        } (location), i * 200);
    }

}

updateMap();