var mapHandler = (function () {
	var customMarker = {
		path:'M 5 5 L 15 5 L 10 15 z',
		fillColor:'red',
		fillOpacity: 0.2,
		scale:3,
		strokeColor: 'gold',
		strokeWeight: 3
	};

	var contentString;

	var infoWindow = new google.maps.InfoWindow({
		content: contentString
	});

	function createMarkers(i, that) {
		var self = that;
		contentString = '<div id="content>' + '<div id="siteNotice>' + '</div>' +
				'<h1 id="firstHeading" class="firstHeading">' + self.restaurantList[i].name + '</h1>' + '</div>';

		var markerPos = {lat: parseFloat(self.restaurantList[i].lat), lng: parseFloat(self.restaurantList[i].lng)};
		var marker = new google.maps.Marker({
			position: markerPos,
			map: map,
			title: self.restaurantList[i].name,
			icon: customMarker
		});

		addListenerPerMarker(i, marker);

		self.markerList.push({position: markerPos, restaurant: self.restaurantList[i]});
		console.log("Added: " + self.restaurantList[i].name);
		console.log("Full Obj " + self.restaurantList[i]);
	}

	function addListenerPerMarker(i, marker, that) {
		var self = that;

		google.maps.event.addListener(marker, 'click', (function (marker, i){
			return function(){
				infoWindow.setContent(self.restaurantList[i].name);
				infoWindow.open(map, marker);
			}
		})(marker, i));
	}

	function addToMakerList(that) {
		var self = that;
		var perLoop = 7;
		var loops = Math.ceil(self.restaurantList.length / perLoop);

		for (var j = 0; j < loops; j ++)
		{
			setTimeout(function(loop){
				return function() {
					var startingIndex = loop*perLoop;

					for (var i = startingIndex; i < Math.min(self.restaurantList.length, startingIndex + perLoop); i ++){
						createMarkers(i, self);
					}
				}
			}(j), 1000*(j+1));

		}
	}

	function cleanData(data, that) {
		var self = that;
		for (var i=0; i < data.length; i++) {
			self.restaurantList.push({name: data[i].placename, lat:data[i].geoLat, lng:data[i].geoLng});
		}
	}

	function storeMarkerInfo(data) {
		var that = this;
		//this get list of restaurants, cleans them up, adds to restaurant list
		cleanData(data, that);

		//creates markers based on geo location per restaurant
		addToMakerList(that);
	}

	return {
		restaurantList: [],
		markerList: [],
		map: null,
		ctx: null,

		createMarkerList: function () {
			this.restaurantList = [];
			this.markerList = [];
			ajaxHelper.fetchData(storeMarkerInfo, this)
		}
	}
})();


