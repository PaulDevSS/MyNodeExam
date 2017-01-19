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
		height: 700px;
	}

	</style>

</head>
<body>
	
	<div class="alert alert-dismissible alert-danger">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h4>Warning!</h4>
	  <p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, <a href="#" class="alert-link">vel scelerisque nisl consectetur et</a>.</p>
	</div>

	<div id="map"></div>

	<div>Coordinate : <span id = "coordinate"></span></div>

	<div class="tweet"></div>




	<script
	  src="https://code.jquery.com/jquery-3.1.1.min.js"
	  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	  crossorigin="anonymous">	
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd5KONSoti7D3ku-hT-47gY2LuExOtUcw&callback=initMap" async defer></script>

	

	<script src="oauth.js"></script>

	<script type="text/javascript">

		var map;
		var marker;
		var circle;

		$(document).ready(function() {
			
			OAuth.initialize('aaOi_JjbM3fNth9xh1H5ZoXgV2Q');
			OAuth.popup('twitter').done(function(result) {
			    console.log(result);
			    // do some stuff with result




			    getTwitterResult(result);
			    // google.maps.event.addListener(map, 'center_changed', function() { console.info('center_changed'); getTwitterResult(result); circle.setMap(null); setCircle(); } );
			    google.maps.event.addListener(map, 'center_changed', function() { console.info('center_changed'); circle.setMap(null); setCircle(); } );
			    google.maps.event.addListener(map, 'dragend', function() { console.info('dragend'); getTwitterResult(result); } );

			    

			});

		});

		function getTwitterResult(result) {

			$(".tweet").empty();
			
			result.get('https://api.twitter.com/1.1/search/tweets.json?geocode='+map.getCenter().lat()+','+map.getCenter().lng()+',50mi')
		    .done(function (response) {
		        //this will display "John Doe" in the console
		        console.log(response);

		        $.each(response.statuses, function(index, val) {
		        	 /* iterate through array or object */

		        	 $(".tweet").append(val.created_at+" : "+val.text+"<br />");

		        });

		    })
		    .fail(function (err) {
		        //handle error with err
		    });
		}

	</script>

	<!-- 	
		OAuth.initialize('aaOi_JjbM3fNth9xh1H5ZoXgV2Q')
		OAuth.popup('twitter').done(function(result) {
		    console.log(result)
		    // do some stuff with result
		})
		The console print:

		{
		  "oauth_token": "2986494019-MDFr1Rr4tS2hGsTTXxmp3TtF4mBxyVqGz98MiPL",
		  "oauth_token_secret": "YfSrZuh7bY8HXrTLdHJuOjYjKU7FUi4zZeRNcc2OxQYRL",
		  "provider": "twitter"
		}
		result contains also additional methods to ease your API calls

		me() - Retrieve the user connected in a unified form (if the provider support this method)

		result.me().done(function(data) {
		    // do something with `data`, e.g. print data.name
		})
		You can now make simple HTTP calls using these functions: get(url, settings), post(url, settings), put(url, settings), delete(url, settings), patch(url, settings)

		These methods take the same parameter than jQuery.ajax(). It injects all authorization parameters (access token, signature, nonce, timestamp etc...) for you and proxy your API calls if needed.
	 -->

	<script type="text/javascript">
	
	  function initMap() {
	    
	    // getLocation();
	    showDefaultPosition();
	  }

	  function getLocation() {

	  	  alert('here');

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

		// google.maps.event.addListener(map, 'center_changed', function() { console.info('center_changed'); circle.setMap(null); setCircle(); } );

	}

	function setCircle() {

		console.log(map.getCenter().lat(), map.getCenter().lng());
		$("#coordinate").text(map.getCenter().lat()+","+map.getCenter().lng());
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

</body>
</html>

<!-- AIzaSyDd5KONSoti7D3ku-hT-47gY2LuExOtUcw -->
<!-- https://api.twitter.com/1.1/search/tweets.json?geocode=37.781157,-122.398720,1mi -->