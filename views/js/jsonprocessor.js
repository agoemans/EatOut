

var ajaxHelper = (function(){
    var xhttp;
    var url = 'http://localhost:8000/api';

    return {
        callHTTP: function (url,callback, context){
            xhttp = new XMLHttpRequest();

            xhttp.onload=function(){
                callback.call(context,xhttp.responseText);
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        },

        getJson: function (callback, context){
            this.callHTTP(url, function(data){

                var obj = JSON.parse(data);
                callback.call(context, obj);

            }, this);

        }

    }

})();

var cleanAPIData = (function(){

    function getStreetNames(array) {
        for (var i=0; i < array.length; i++) {
            resultsList.push({name: array[i].placename, lat:array[i].geoLat, lng:array[i].geoLng});
        }
        console.log(resultsList);
        return resultsList;
    }

    return {
        getStreetNames: getStreetNames,
        //onJSONLoad: function(data){
        //    var obj = JSON.parse(data);
        //    console.log(obj);
        //
        //    callback.call(cintwx, obj);
        //},

        getDataFromServer: function (callback, context){
            ajaxHelper.getJson(callback, context);
        }
    }
})();
//
//cleanAPIData.getDataFromServer(function(obj){
//    console.log(obj);
//}, this);



