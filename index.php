<!DOCTYPE html>
<html>
<head>
	<title>Simple Map</title>
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
	<style>
    	/* Always set the map height explicitly to define the size of the div
    	* element that contains the map. */
    	#map {
    		height: 300px;
    	}

    	/* Optional: Makes the sample page fill the window. */
    	html,
    	body {
    		height: 100%;
    		margin: 0;
    		padding: 0;
    	}
    </style>
    <script>
    	let map;
    	var pos = [];
	    	navigator.geolocation.getCurrentPosition(position => {
	    		pos = { lat: position.coords.latitude, lng: position.coords.longitude }
	    	})
    		console.log(pos)

    	function initMap() {
    		map = new google.maps.Map(document.getElementById("map"), {
    			center: pos,
    			zoom: 15,
    			mapId: '93574349857cf182'
    		});
			  // The marker, positioned at Uluru
			  const image =
			    "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
			  const marker = new google.maps.Marker({
			  	position: pos,
			  	map: map,
			  	title: "Rajadesa",
			  	icon: image
			  });
			}
</script>
</head>
<body>
	<div id="map"></div>

	<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
	<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6635t5hX8gRANuQ_3XIYuy1npO9yMgmM&callback=initMap&v=weekly"
	async
	></script>
</body>
</html>