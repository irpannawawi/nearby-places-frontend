<!DOCTYPE html>
<html>
<head>
	<title>Simple Map</title>
	<meta name="viewport" content="initial-scale=1.0, width=device-width" />

	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
  type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
  type="text/javascript" charset="utf-8"></script>

    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"
       type="text/javascript" charset="utf-8"></script>
       
  <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"
            type="text/javascript" charset="utf-8"></script>
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <link rel="stylesheet" type="text/css"
            href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />

</head>
<body>
 <div style="width: 640px; height: 480px" id="mapContainer"></div>

 <script type="text/javascript">
 	var platform = new H.service.Platform({
	  'apikey': 'xi1Db8SdDeIbw61oxXwypXPouvms9hSZ7dxdFBwPb7g'
	});

	var defaultLayers = platform.createDefaultLayers();

/*	async function getLocation() {
		
	}*/
	async function createMap(pos){
		const getTempat = await axios.get(`https://api-nearby-app.herokuapp.com/search?latitude=${pos[0]}&longitude=${pos[1]}&kategori=9`)
		console.log(pos)
		const centerLocation = {lat: pos[0], lng: pos[1]}
		console.log({msg: centerLocation})
		// Instantiate (and display) a map object:
		var map = new H.Map(
		    document.getElementById('mapContainer'),
		    defaultLayers.vector.normal.map,
		    {
		      zoom: 15,
		      center: centerLocation
		    });
		// add marker
		// get data
		const tempat = getTempat.data.data
		
		for(let i =0; i < tempat.length; i++){
			var marker = new H.map.Marker({lat: tempat[i].latitude, lng: tempat[i].longitude});
			map.addObject(marker)
		}

		var mapEvents = await new H.mapevents.MapEvents(map);
		var behavior = new H.mapevents.Behavior(mapEvents);
		var ui = H.ui.UI.createDefault(map, defaultLayers);
	}

const render = new Promise(( resolve, reject )=>{
	var pos = [];
		navigator.geolocation.getCurrentPosition(position=>{
			pos.push(position.coords.latitude)
			pos.push(position.coords.longitude)
			createMap(pos);
		})
		resolve("ok")
})

render
	.then(p=>{
		console.log(p)
	})
 </script>
</body>
</html>