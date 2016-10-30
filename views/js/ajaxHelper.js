var ajaxHelper = (function () {//todo rename all the files, including this one to handler or something
	var xhttp;
	var url = apiURL;

	function callHTTP(url, callback, context) {
		xhttp = new XMLHttpRequest();
		xhttp.onload = function () {
			callback.call(context, xhttp.responseText);
		};
		xhttp.open("GET", url, true);
		xhttp.send();
	}
	function getJson(callback, context) {
		callHTTP(url, function (data) {

			var obj = JSON.parse(data);
			console.log(obj);
			callback.call(context, obj);

		}, this);
	}
	return {
		onComplete: null,
		fetchData: function (cb, ctx) {
			getJson(cb, ctx)
		}
	}

})();



