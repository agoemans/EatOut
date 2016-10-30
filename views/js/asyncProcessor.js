function AsyncProcessor (){
    this.onComplete;

    this.setCallback = function(cb, ctx){
        this.onComplete = {
            callback: cb,
            context: ctx
        }
    }

    this.processData = function (data) {
        this.onComplete.callback.call(this.onComplete.context, data);
    }

    this.fetchData = function (){
        httpHelper.getJson(this.processData,this)
    }
};