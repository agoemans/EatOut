var app = (function(){
	function initMap() {
		map = new google.maps.Map(document.getElementById('map-canvas'), {
			center: {lat: 52.3837955, lng: 4.9130078},
			zoom: 13,
			mapTypeControlOptions: {
				mapTypeIds: ['roadmap', 'styled_map']
			},
			mapTypeIds: 'styled_map'
		});

		createStyledMap();

		map.mapTypes.set('styled_map', styledMapType);
		map.setMapTypeId('styled_map');

		google.maps.event.addListener(map, 'idle', showMarkers);
	}

	function createStyledMap() {
		styledMapType = new google.maps.StyledMapType(
				styledMapTypeData.styleElement,
				{name: 'styled_map'});
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
		updateMap: function (){
			initMap();
			mapHandler.createMarkerList();
		}
	}

})();
function initMap() {
	map = new google.maps.Map(document.getElementById('map-canvas'), {
		center: {lat: 52.3837955, lng: 4.9130078},
		zoom: 13,
		mapTypeControlOptions: {
			mapTypeIds: ['roadmap', 'styled_map']
		},
		mapTypeIds: 'styled_map'
	});

	createStyledMap();

	map.mapTypes.set('styled_map', styledMapType);
	map.setMapTypeId('styled_map');

	google.maps.event.addListener(map, 'idle', showMarkers);
}

function updateMap() {
	initMap();
	ajaxHelper.callbackHandler(this.gotData, this);
	ajaxHelper.fetchData(this.gotData, this);
	//dataProcessor = new dataProcessor(this.gotData, this);
	//dataProcessor.fetchData();

}

function createStyledMap() {
	//todo move this to global
	styledMapType = new google.maps.StyledMapType(
		styledMapTypeData.styleElement,
		{name: 'styled_map'});
}

function gotData(data) {
	//var markerGroup = [];
	var res = cleanAPIData.getStreetNames(data);

	//createMarkers(res);

	//return markerPositionList;
	//setMarkerOnMap(markerGroup);

	//this bit is the one I will keep - new bits

/*	var mapProcessor = new MapProcessor();

	mapProcessor.getDataFromDB();*/

	//gets data from db, cleans them, gets marker per item and adds to map
	mapHandler.createMarkerList();
	//console.log(mapProcessor.markerList);
	//end of bit to keep
}

function createMarkers(arr) {
	var customMarker = {
		path: 'M 100 100 L 300 100 L 200 300 z',
		fillColor: 'yellow',
		fillOpacity: 0.8,
		scale: 1,
		strokeColor: 'gold',
		strokeWeight: 14
	}

	if (arr < 10) {
		counter = arr.length
	} else {
		counter = 10;
	}
	for (var i = 0; i < 4; i++) {
		//console.log(i, arr[4])
		var markerPos = {lat: parseFloat(arr[i].lat), lng: parseFloat(arr[i].lng)};
		var marker = new google.maps.Marker({
			position: markerPos,
			map: map,
			title: arr[i].placename,
			icon: customMarker
		});
		markerGroup.push(marker);
	}
}


function setMarkerOnMap(data) {
	var markerHolder = data;

	for (var i = 0; i < Math.min(markerHolder.length, 6); i++) {
		var location = markerHolder[i];
		window.setTimeout(function (location) {
			return function () {
				location.setMap(map);
			}
		}(location), i * 200);
	}
}

function showMarkers() {
	//todo use this for cluster bounds fix
	var testLatLng = {lat: 52.378010, lng: 4.895868};
	var bounds = map.getBounds();
	var ne = bounds.getNorthEast();
	var sw = bounds.getSouthWest();
	console.log(ne.lat(), ne.lng(), sw.lat(), sw.lng())
}

app.updateMap();