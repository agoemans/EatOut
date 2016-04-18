function mapProcessor(){
        this.restaurantList = [];
        this.markerList = [];
        this.map = null;
}

mapProcessor.prototype.getDataFromDB = function () {
    asyncProcessor(this.storeMarkerInfo, this);
    asyncProcessor.fetchData();
};

mapProcessor.prototype.cleanDBData = function (data) {
    for (var i=0; i < data.length; i++) {
        this.restaurantList.push({name: data[i].placename, lat:data[i].geoLat, lng:data[i].geoLng});
    }

};

mapProcessor.prototype.storeMarkerInfo = function (data) {
    this.cleanDBData(data);
    var tempList;
    var x = 0;
    while (x < 10){
        setTimeout(function(){
            for (var i = 0; i < 10; i ++){
                var markerPos = {lat: parseFloat(this.restaurantList[i].lat), lng: parseFloat(this.restaurantList[i].lng)};
                var marker = new google.maps.Marker({
                    position: markerPos,
                    map: map,
                    title: restaurantList[i].placename
                });
                this.markerList.push(marker);
            }
            this.restaurantList.splice(0,10);
        }, 10000);
        x++;
    }
};

mapProcessor.prototype.processMarkerInfo = function (arr) {

};

mapProcessor.prototype.updateMap = function () {

};

module.exports = mapProcessor;