//var httpHelper = require('AsyncProcessor');
function MapProcessor(){
        this.restaurantList = [];
        this.markerList = [];
        this.map = null;
}

MapProcessor.prototype.getDataFromDB = function () {
    var asyncProcessor = new AsyncProcessor();
    asyncProcessor.setCallback(this.storeMarkerInfo, this);
    //asyncProcessor(this.storeMarkerInfo, this);
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

    var perLoop = 5;

    var loops = Math.ceil(this.restaurantList.length / perLoop);

    var that = this;

    for (var j = 0; j < loops; j ++)
    {
        setTimeout(function(loop){
            return function() {
                var startingIndex = loop*perLoop;

                for (var i = startingIndex; i < Math.min(that.restaurantList.length, startingIndex + perLoop); i ++){
                    var markerPos = {lat: parseFloat(that.restaurantList[i].lat), lng: parseFloat(that.restaurantList[i].lng)};
                    var marker = new google.maps.Marker({
                        position: markerPos,
                        map: map,
                        title: that.restaurantList[i].name
                    });
                    that.markerList.push(marker);
                    console.log("Added: " + that.restaurantList[i].name);
                }
            }
        }(j), 1000*(j+1));

    }
};

MapProcessor.prototype.processMarkerInfo = function (arr) {

};

MapProcessor.prototype.updateMap = function () {

};

//module.exports = MapProcessor;