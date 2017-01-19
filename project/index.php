<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Google Twitter Location Base</title>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://bootswatch.com/sandstone/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<style type="text/css">
		
	#map {

		width: 100%;
		height: 500px;
	}

	</style>

</head>
<body>
	
	<div class="alert alert-dismissible alert-warning">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h4>Warning!</h4>
	  <p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, <a href="#" class="alert-link">vel scelerisque nisl consectetur et</a>.</p>
	</div>

	<div id="map"></div>





	<script>

	var map;
	var marker;
	var circle;
	
	  function initMap() {
	    
	    getLocation();
	  }

	  function getLocation() {

		  if (navigator.geolocation) {

		    navigator.geolocation.getCurrentPosition(showCurrentPosition);

		  } else {

		    alert("Geolocation is not supported by this browser.");

		    showDefaultPosition();

		  }
		}

	function showCurrentPosition(position) {

	  var lat = position.coords.latitude;
	  var lng = position.coords.longitude;
	  // map.setCenter(new google.maps.LatLng(lat, lng));

	  map = new google.maps.Map(document.getElementById('map'), {
	      center: {lat: lat, lng: lng},
	      scrollwheel: true,
	      zoom: 8
	    });

	  nextProcess();
	}

	function showDefaultPosition() {
		
		//Create a map object and specify the DOM element for display.
	    map = new google.maps.Map(document.getElementById('map'), {
	      center: {lat: 13.6741713, lng: 100.608395},
	      scrollwheel: true,
	      zoom: 8
	    });

	    nextProcess();
	}

	function nextProcess() {

		setCircle();

		// google.maps.event.addListener(map, 'bounds_changed', function() { console.info('bounds_changed'); } );
		// google.maps.event.addListener(map, 'center_changed', function() { console.info('center_changed'); } );
		// google.maps.event.addListener(map, 'click', function() { console.info('click'); } );
		// google.maps.event.addListener(map, 'dblclick', function() { console.info('dblclick'); } );
		// google.maps.event.addListener(map, 'drag', function() { console.info('drag'); } );
		// google.maps.event.addListener(map, 'dragend', function() { console.info('dragend'); } );
		// google.maps.event.addListener(map, 'dragstart', function() { console.info('dragstart'); } );
		// google.maps.event.addListener(map, 'heading_changed', function() { console.info('heading_changed'); } );
		// google.maps.event.addListener(map, 'idle', function() { console.info('idle'); } );
		// google.maps.event.addListener(map, 'maptypeid_changed', function() { console.info('maptypeid_changed'); } );
		// google.maps.event.addListener(map, 'mousemove', function() { console.info('mousemove'); } );
		// google.maps.event.addListener(map, 'mouseout', function() { console.info('mouseout'); } );
		// google.maps.event.addListener(map, 'mouseover', function() { console.info('mouseover'); } );
		// google.maps.event.addListener(map, 'projection_changed', function() { console.info('projection_changed'); } );
		// google.maps.event.addListener(map, 'resize', function() { console.info('resize'); } );
		// google.maps.event.addListener(map, 'rightclick', function() { console.info('rightclick'); } );
		// google.maps.event.addListener(map, 'tilesloaded', function() { console.info('tilesloaded'); } );
		// google.maps.event.addListener(map, 'tilt_changed', function() { console.info('tilt_changed'); } );
		// google.maps.event.addListener(map, 'zoom_changed', function() { console.info('zoom_changed'); } );

		google.maps.event.addListener(map, 'center_changed', function() { console.info('center_changed'); circle.setMap(null); setCircle(); } );

	}

	function setCircle() {

		console.log(map.getCenter().lat(), map.getCenter().lng());
		// marker.setMap(null);
		// circle.setMap(null);
		
		// Create marker 
		marker = new google.maps.Marker({
		  map: map,
		  position: new google.maps.LatLng(map.getCenter().lat(), map.getCenter().lng()),
		  title: 'Center Radius'
		});

		// Add circle overlay and bind to marker
		circle = new google.maps.Circle({
		  map: map,
		  radius: 50000,    // 10 miles in metres // UNIT METER
		  fillColor: '#cccccc'
		});
		circle.bindTo('center', marker, 'position');
		marker.setMap(null);

	}

	</script>

	<script
	  src="https://code.jquery.com/jquery-3.1.1.min.js"
	  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	  crossorigin="anonymous">	
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd5KONSoti7D3ku-hT-47gY2LuExOtUcw&callback=initMap" async defer></script>


</body>
</html>

<!-- AIzaSyDd5KONSoti7D3ku-hT-47gY2LuExOtUcw -->
<!-- https://api.twitter.com/1.1/search/tweets.json?geocode=37.781157,-122.398720,1mi -->