var mapHandler = (function () {
	var customMarker = {
		path: 'M 5 5 L 15 5 L 10 15 z',
		fillColor: 'red',
		fillOpacity: 0.2,
		scale: 3,
		strokeColor: 'gold',
		strokeWeight: 3
	};

	var contentString;

	var infoWindow = new google.maps.InfoWindow({
		content: contentString
	});

	function createMarkers(item, that) {
		var self = that;
		var restaurant = item;

		updateContentString(restaurant);

		var markerPos = {lat: parseFloat(restaurant.lat), lng: parseFloat(restaurant.lng)};
		var marker = new google.maps.Marker({
			position: markerPos,
			map: map,
			title: restaurant.name,
			icon: customMarker
		});

		addListenerPerMarker(restaurant, marker);

		self.markerList.push({position: markerPos, restaurant: restaurant});
		console.log("Added: " + restaurant.name);
		console.log("Full Obj " + restaurant);
	}

	function addListenerPerMarker(item, marker, that) {
		var restaurant = item;
		google.maps.event.addListener(marker, 'click', (function (marker, restaurant, that) {
			var self = that;
			return function () {
				infoWindow.setContent(restaurant.name);
				infoWindow.open(map, marker);
			}
		})(marker, restaurant, that));
	}

	function addToMakerList(that) {
		var self = that;
		var perLoop = 7;
		var loops = Math.ceil(self.restaurantList.length / perLoop);

		for (var j = 0; j < loops; j++) {
			setTimeout(function (loop) {
				return function () {
					var startingIndex = loop * perLoop;

					for (var i = startingIndex; i < Math.min(self.restaurantList.length, startingIndex + perLoop); i++) {
						createMarkers(self.restaurantList[i], self);
					}
				}
			}(j), 1000 * (j + 1));

		}
	}

	function updateContentString(item) {
		var restaurant = item;
		contentString = '<div id="content">' + '<div id="siteNotice">' + '</div>' +
				'<h1 id="firstHeading" class="firstHeading">' + restaurant.name + '</h1>' +
				'<h2 id="secondHeading" class="secondHeading">' + restaurant.street + '</h2>' +
				'<h2 id="thirdHeading" class="thirdHeading">' + restaurant.zipcode + '</h2>' +
				'<h3 id="fourthHeading" class="fourthHeading">' + restaurant.tel + '</h3>' +
				'</div>';

		console.log(contentString);
	}

	function cleanData(data, that) {
		var self = that;
		for (var i = 0; i < data.length; i++) {
			self.restaurantList.push({
				name: data[i].placename,
				lat: data[i].geoLat,
				lng: data[i].geoLng,
				street: data[i].streetname,
				zip: data[i].zipcode,
				tel: data[i].telephone
			});
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


