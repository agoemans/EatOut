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

    var res = cleanAPIData.getStreetNames(data);

    for(var i=0; i < res.length; res++){
        var markerPos = new google.maps.LatLng(res[i].lat, res[i].lng);
        var marker = new google.maps.Marker({
            position: markerPos,
            map: map,
            title: 'Hello World!'
        });
        marker.setMap(map);
    }

    //var marker = new google.maps.Marker({
    //    position: myLatLng,
    //    map: map,
    //    title: 'Hello World!'
    //});
}

updateMap();