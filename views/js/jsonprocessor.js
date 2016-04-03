var ajaxHelper = (function(){
    var xhttp;

    return {
        callHTTP: function (url,callback, context){
            xhttp = new XMLHttpRequest();

            xhttp.onload=function(){
                callback.call(context,xhttp.responseText);
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        },

        getJson: function (url,callback, context){
            this.callHTTP(url, function(data){

                var obj = JSON.parse(data);
                callback.call(context, obj);

            }, this);

        }

    }

})();

var getData = (function(){
    var url = 'http://localhost:8000/api';

    return {
        //onJSONLoad: function(data){
        //    var obj = JSON.parse(data);
        //    console.log(obj);
        //
        //    callback.call(cintwx, obj);
        //},

        getDataFromServer: function (callback, context){
            ajaxHelper.getJson(url, callback, context);
        }
    }
})();

getData.getDataFromServer(function(obj){
    console.log(obj);
}, this);

