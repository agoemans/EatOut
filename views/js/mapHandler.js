function MapHandler() {

	this.restaurantList = [];

	this.map = null;

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

	// private
	var createMarker = function(item) {
		var restaurant = item;

		var markerPos = {lat: parseFloat(restaurant.lat), lng: parseFloat(restaurant.lng)};

		var marker = new google.maps.Marker({
			position: markerPos,
			map: map,
			title: restaurant.name,
			icon: customMarker
		});

		return marker;
	}

	// private
	var addListenerPerMarker = function(restaurant, marker) {

		google.maps.event.addListener(marker, 'click', (function (marker, restaurant) {
			return function () {
				infoWindow.setContent(createContentString(restaurant));
				infoWindow.open(map, marker);
			}
		})(marker, restaurant));
	}

	this.addToMarkerList = function() {

		var perLoop = 7;

		var loops = Math.ceil(this.restaurantList.length / perLoop);

		var self = this;

		for (var j = 0; j < loops; j++) {
			//need delay when getting large number of marker info from Google Maps
			setTimeout(function (loop) {
				return function () {
					var startingIndex = loop * perLoop;

					for (var i = startingIndex; i < Math.min(self.restaurantList.length, startingIndex + perLoop); i++) {
						var restaurant = self.restaurantList[i];

						var marker = createMarker(restaurant);

						addListenerPerMarker(restaurant, marker);
					}
				}
			}(j), 1000 * (j + 1));

		}
	}

	// private
	var createContentString = function(item) {
		var restaurant = item;
		contentString = '<div id="content">' + '<div id="siteNotice">' + '</div>' +
				'<h1 id="firstHeading" class="firstHeading">' + restaurant.name + '</h1>' +
				'<h2 id="secondHeading" class="secondHeading">' + restaurant.street + '</h2>' +
				'<h2 id="thirdHeading" class="thirdHeading">' + restaurant.zip + '</h2>' +
				'<h3 id="fourthHeading" class="fourthHeading">' + restaurant.tel + '</h3>' +
				'</div>';

		return contentString;
	}

	this.addToRestaurantList = function(data) {

		for (var i = 0; i < data.length; i++) {
			this.restaurantList.push({
				name: data[i].placename,
				lat: data[i].geoLat,
				lng: data[i].geoLng,
				street: data[i].streetname,
				zip: data[i].zipcode,
				tel: data[i].telephone
			});
		}
	}

	this.storeMarkerInfo = function(data) {

		//this get list of restaurants, cleans them up, adds to restaurant list
		this.addToRestaurantList(data);

		//creates markers based on geo location per restaurant
		this.addToMarkerList();
	}


	this.createMarkerList = function () {
		this.restaurantList = [];
		ajaxHelper.fetchData(this.storeMarkerInfo, this)
	}
}


