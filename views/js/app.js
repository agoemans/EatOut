var app = (function () {
	function initMap() {
		map = new google.maps.Map(document.getElementById('map-canvas'), {
			center: {lat: 52.3837955, lng: 4.9130078},
			zoom: 13,
			mapTypeControlOptions: {
				mapTypeIds: ['map']
			},
			mapTypeIds: 'map'
		});

		createStyledMap();

		map.mapTypes.set('map', styledMapType);
		map.setMapTypeId('map');

		google.maps.event.addListener(map, 'idle', showMarkers);
	}

	function createStyledMap() {
		styledMapType = new google.maps.StyledMapType(
			styledMapTypeData.styleElement,
			{name: 'map'});
	}

	function showMarkers() {
		//todo use this for cluster bounds fix
		var testLatLng = {lat: 52.378010, lng: 4.895868};
		var bounds = map.getBounds();
		var ne = bounds.getNorthEast();
		var sw = bounds.getSouthWest();
		console.log(ne.lat(), ne.lng(), sw.lat(), sw.lng())
	}

	return {
		updateMap: function () {
			initMap();
			var mapHandler = new MapHandler();
			mapHandler.createMarkerList();
		}
	}

})();


app.updateMap();