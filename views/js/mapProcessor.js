function mapProcessor(){
        this.restaurantList = [];
        this.markerList = [];
        this.map = null;
}

mapProcessor.prototype.getDataFromDB = function () {
    dataprocessor = new dataProcessor(this.storeMarkerInfo, this);
    dataProcessor.fetchData();
};

mapProcessor.prototype.cleanDBData = function (data) {
    for (var i=0; i < data.length; i++) {
        this.restaurantList.push({name: data[i].placename, lat:data[i].geoLat, lng:data[i].geoLng});
    }

};

mapProcessor.prototype.storeMarkerInfo = function (data) {
    this.cleanDBData(data);
    var tempList;
    setTimeout(function(){
        this.processMarkerInfo()

    }, 10000)

    var i = 0;
    var startPos = 0;
    var endPos = 11;
    while (i < 10){
        tempList = this.restaurantList.slice(startPos, endPos);
        startPos += endPos;
        endPos += endPos;
    }
};

mapProcessor.prototype.processMarkerInfo = function (arr) {

};

mapProcessor.prototype.updateMap = function () {

};

module.exports = mapProcessor;