var httpHelper = (function(){
    var xhttp;
    var url = apiURL;

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