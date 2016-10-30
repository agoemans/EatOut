function MapProcessor(){
        this.restaurantList = [];
        this.markerList = [];
        this.map = null;        
}

MapProcessor.prototype.getDataFromDB = function () {
    var asyncProcessor = new AsyncProcessor();
    asyncProcessor.setCallback(this.storeMarkerInfo, this);
    asyncProcessor.fetchData();
};

MapProcessor.prototype.cleanDBData = function (data) {
    for (var i=0; i < data.length; i++) {
        this.restaurantList.push({name: data[i].placename, lat:data[i].geoLat, lng:data[i].geoLng});
    }

};

MapProcessor.prototype.storeMarkerInfo = function (data) {
    this.cleanDBData(data);
    var tempList;

    var perLoop = 7;

    var loops = Math.ceil(this.restaurantList.length / perLoop);

    var that = this;

    var customMarker = {
        path:'M 5 5 L 15 5 L 10 15 z',
        fillColor:'red',
        fillOpacity: 0.2,
        scale:3,
        strokeColor: 'gold',
        strokeWeight: 3
    };

    var contentString;

    var infoWindow = new google.maps.InfoWindow({
        content: contentString
    });

    for (var j = 0; j < loops; j ++)
    {
        setTimeout(function(loop){
            return function() {
                var startingIndex = loop*perLoop;

                for (var i = startingIndex; i < Math.min(that.restaurantList.length, startingIndex + perLoop); i ++){
                    contentString = '<div id="content>' + '<div id="siteNotice>' + '</div>' +
                    '<h1 id="firstHeading" class="firstHeading">' + that.restaurantList[i].name + '</h1>' + '</div>';
                    
                    var markerPos = {lat: parseFloat(that.restaurantList[i].lat), lng: parseFloat(that.restaurantList[i].lng)};
                    var marker = new google.maps.Marker({
                        position: markerPos,
                        map: map,
                        title: that.restaurantList[i].name,
                        icon: customMarker
                    });
                    
                    google.maps.event.addListener(marker, 'click', (function (marker, i){
                        return function(){
                            infoWindow.setContent(that.restaurantList[i].name);
                            infoWindow.open(map, marker);
                        }
                    })(marker, i));
                                      
                    that.markerList.push({position: markerPos, restaurant: that.restaurantList[i]});
                    console.log("Added: " + that.restaurantList[i].name);
                    console.log("Full Obj " + that.restaurantList[i]);
                }
            }
        }(j), 1000*(j+1));

    }

};

MapProcessor.prototype.setMarkersOnMap = function () {
    for(var i=0; i < Math.min(this.markerList.length, 6); i++){
        var marker = new google.maps.Marker({
            position: this.markerList[i].position,
            map: map,
            title: this.markerList[i].restaurant.name
        });
        var location = marker;
        window.setTimeout(function(location){
            return function (){ location.setMap(map);}
        } (location), i * 200);
    }
};
