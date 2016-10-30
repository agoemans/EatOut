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

var cleanAPIData = {
    resultsList: [],
    getStreetNames: function (array) {
        for (var i=0; i < array.length; i++) {
            cleanAPIData.resultsList.push({name: array[i].placename, lat:array[i].geoLat, lng:array[i].geoLng});
        }
        console.log(cleanAPIData.resultsList);
        return cleanAPIData.resultsList;
    },

    getDataFromServer: function (callback, context){
        ajaxHelper.getJson(callback, context);
    }

};

function dataProcessor (cb, ctx) {
    this.onComplete = {
        callback: cb,
        context: ctx
    };

    this.processData = function (data) {
        this.onComplete.callback.call(this.onComplete.context, data);
    }

    this.fetchData = function (){
        ajaxHelper.getJson(this.processData,this)
    }

};



