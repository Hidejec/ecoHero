<?php
require_once('core/init.php');
$query = DB::query()->select_fetch("fuel/*", "user_id=1");

?>



    <script type="text/javascript">

        var source, destination;
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        google.maps.event.addDomListener(window, 'load', function () {
            new google.maps.places.SearchBox(document.getElementById('txtSource'));
            new google.maps.places.SearchBox(document.getElementById('txtDestination'));
            directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true });
        });

        function GetRoute() {


            var phil = new google.maps.LatLng(13.0000, 122.0000);
            var mapOptions = {
                zoom: 5,
                center: phil
            };
            map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('dvPanel'));

            //*********DIRECTIONS AND ROUTE**********************//
            source = document.getElementById("txtSource").value;
            destination = document.getElementById("txtDestination").value;

            var request = {
                origin: source,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                }
            });

            //*********DISTANCE AND DURATION**********************//
            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix({
                origins: [source],
                destinations: [destination],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false


            }, 




            function (response, status) {
                if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                    var distance = response.rows[0].elements[0].distance.value;
                    var duration = response.rows[0].elements[0].duration.text;
                    var dvDistance = document.getElementById("dvDistance");

                    distance /= 1000;
                    dvDistance.innerHTML = "";
                    dvDistance.innerHTML += "Distance: " + distance + " km" + "<br />";
                    dvDistance.innerHTML += "Duration: " + duration + "<br />";


                } else {
                    alert("Unable to find the distance via road.");
                }
            });
        }
    </script>




<form method="post" action="fuel.inc.php">
    Source: <input type="text" id="txtSource" value="" style="width: 325px" /> <br> 
                
    Destination: <input type="text" id="txtDestination" value="" style="width: 325px" /> <br>
                
	mpg of your car: <input type="text" name="mpg"> <br>
	type of fuel: <select id="gastype">
  					<option value="diesel">Diesel</option>
  					<option value="gasoline">Gasoline</option>
  		  		  </select>  <br><br>
	km distance of car <input type="text" name="km"> <br>
	fuel used <input type="text" name="fuel_used"> <br>
	fuel cost <input type="text" name="fuel_cost"> <br>

	<input type="submit" value="Log it"> <input type="button" value="Get Route" onclick="GetRoute()" />
</form>

<div id="dvMap" style="width: 600px; height: 500px">

<fieldset>
<h3>---------Logs---------</h3>
<?php foreach($query as $querykey): ?>
<table border=0>
	<tr>
		<td>You have traveled <?php echo $querykey['km']; ?>
			km and have used <?php echo $querykey['fuel']; ?>
			Liters on <?php echo date('M-d-Y h:i:s', strtotime($querykey['date_created'])); ?>
			<a href="fuel_delete.php?action=delete&id=<?php echo $querykey['id'] ?>">Delete</a>
		</td>
	</tr>
</table>
<?php endforeach; ?>
</fieldset>

<fieldset>
<h3>---------Graph---------</h3>

</fieldset>