function asyncProcessor (cb, ctx) {
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