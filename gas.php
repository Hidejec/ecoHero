<?php
require_once('core/init.php');
$id = @$_SESSION['user_id'];
if($id === null){
    $id = 0;
}
$query = DB::query()->select_fetch("fuel/*", "user_id=$id");

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        body
        {
            font-family: Arial;
            font-size: 10pt;
        }
    </style>
    <script src="js/jquery.js"></script>
     <script src="js/sugar.js"></script>
     <script src="js/graph2.js"></script>
    <script src="Chartjs/Chart.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="custom.css" />
    <link rel="stylesheet" href="custom@media.css" />
    <!-- lnk to FONTS and font-Icons -->
<link href='https://fonts.googleapis.com/css?family=Ubuntu|Lato' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script type="text/javascript">

        var source, destination;
        var carmpg = 0;
        var carname = "No Selected Car";
        var fuelprice = 0;
        var fuelcost = 0;
        var gastype= "No Selected Gas Type";
        var gasstation= "No Selected Gas Station";
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        google.maps.event.addDomListener(window, 'load', function () {
            new google.maps.places.SearchBox(document.getElementById('txtSource'));
            new google.maps.places.SearchBox(document.getElementById('txtDestination'));
            directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true });
        });

        function GetRoute() {


if(document.getElementById('gastype').options[document.getElementById('gastype').selectedIndex].value == "diesel") 
{
fuelprice = 19.30;
gastype="Diesel";
}

if(document.getElementById('gastype').options[document.getElementById('gastype').selectedIndex].value == "gasoline") 
{
fuelprice = 36.95;
gastype="Gasoline";
}

            var mpg = document.getElementById("carsz").value;
            


            var phil = new google.maps.LatLng(13.0000, 122.0000);
            var mapOptions = {
                zoom: 5,
                center: phil
            };
            map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);
            directionsDisplay.setMap(map);

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
                    var fuelused = distance * mpg;
                    fuelcost = fuelused*fuelprice;
                    $(function(){
                        $.get('core/Controller.php', {
                            distance: distance,
                            fuelused: fuelused,
                            fuelcost: fuelcost,
                            callTo: "gas"
                        }, function(data){
                            
                        });
                    });



                    


                } else {
                    alert("Unable to find the distance via road.");
                }
            });

        }
    </script>
	<!-- START OF NAVBAR-->    
    	<nav class="navbar navbar-custom navbar-fixed-top">
        <div class="setFont">
    			<div class="container" id="navContainer">
    				<div class="navbar-header">
    					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
    						<span class="glyphicon glyphicon-menu-down"></span>
    					</button>
    				</div> <!-- end of navbar header -->

<a href="index.php" class="pull-left">Eco<span class="t">H</span>ero</a>
    				<div class="collapse navbar-collapse" id="navbar-collapse">
    					<ul class="nav navbar-nav">
                            <li><a href="directions.php"><i class="fa fa-map-signs"></i><br>Directions</a></li>
    						<li><a href="bike.php"><i class="fa fa-bicycle"></i><br>Bike</a></li>
    						<li><a href="gas.php"><i class="fa fa-fire"></i><br>Fuel</a></li>
    						<li><a href="co2_calcu.php"><i class="fa fa-bolt"></i><br>CO2</a></li>
                            <li><a href="#"><i class="fa fa-exclamation-triangle"></i><br>Safety</a></li>
                            <li><a href="#"><i class="fa fa-comments"></i><br>Forum</a></li> <!-- wala pa whaha -->
    						<li><a href="aboutus.php"><i class="fa fa-users"></i><br>About Us</a></li>
    					</ul>

             <?php if(!loggedin()): ?>

              <button type="button" class="btn btn-primary outline btn-sm navbar-btn navbar-right" id="btn2" data-toggle="modal" data-target="#loginRegisterModal">
               <span class="glyphicon glyphicon-user glyphy"></span><span class="buttonText"> LOGIN</span>
               <br>
               
               <span class="glyphicon glyphicon-pencil glyphy"></span><span class="buttonText" id="buttonText2">REGISTER</span>
              </button>
            <?php else: ?>

              <a href="logout.php"><button type="button" class="btn btn-primary outline btn-sm navbar-btn navbar-right" id="btn2" data-toggle="modal" data-target="#loginRegisterModal">
               <span class="glyphicon glyphicon-user glyphy"></span><span class="buttonText"> LOGOUT</span>
               <br>
               
               <span class="buttonText" id="buttonText2">      ME</span>
              </button></a>

            <?php endif; ?>
               
    				</div> <!-- nabar header -->
    			</div> <!-- container -->
        </div> <!-- setfont -->
    	</nav>	<!-- end of navbar-->
<!-- Modal -->
<div id="loginRegisterModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
       <ul class="nav nav-tabs">
          <li class="active"><a href="#login" data-toggle="tab" id="modalLink">Login</a></li>
          <li><a href="#register" data-toggle="tab" id="modalLink">Register</a></li>
        </ul>
      </div> 
       <!-- <div class="container col-md-10 col-md-offset-1"> -->
      <div class="modal-body">
      
       <div class="tab-content">
  <div id="login" class="tab-pane fade in active">
    <form role="form" method="post" action="login.inc.php">
       
  <div class="form-group">
    <label for="email">Username:</label>
    <input type="text" class="form-control" id="email" placeholder="Enter your Username" name="username_login">
  </div>
  
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter your Password" name="password_login">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
         <div class="footerTextCenter">
       <br><br>
       <button type="submit" class="btn btn-primary outline btn-sm btn-custom" id="modalbtn">Submit</button> </div> 
</form><!-- end of class form -->
  </div>
  <div id="register" class="tab-pane fade">
    <form role="form" method="post", action="register.inc.php">
       
  <div class="form-group">
    <label for="email">Username:</label>
    <input type="text" class="form-control" id="email" placeholder="Enter your Username" name="username_register">
  </div>
  
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter your Password" name="password_register">
  </div>
  <div class="form-group">
    <label for="pwd">Confirm Password:</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter your Password" name="repassword_register">
  </div>
   <div class="form-group">
    <label for="text">Full Name:</label>
    <input type="text" class="form-control" id="email" placeholder="Enter your Full Name" name="name_register">
  </div>
       <div class="footerTextCenter">
    
       <br>
       <button type="submit" class="btn btn-primary outline btn-sm btn-custom" id="modalbtn">Submit</button> </div> 
        
</form><!-- end of class form -->
  </div>
</div>
    
      </div> <!-- end of class modal-body -->
        <!-- </div> end of container -->
      <div class="modal-footer">
       
        
      </div><!-- end of class modal-footer -->
      </div><!-- end of modal content -->
    </div> <!-- end of modal dialog -->
</div> <!-- end of modal -->
<div class="backColor">
<div class="container fixtoop">
    <div class="row">
    <center><h1>Fuel Cost Calculator</h1></center>
    <br><br>

        <div class="col-md-3">
            <h3>Source: </h3>
                <input type="text" id="txtSource" value="AMA Fairview, Regalado Highway, Quezon City, NCR, Philippines" style="width: 250px" />
                <br> 
        </div>

        <div class="col-md-3">
        <h3>Destination: </h3>
                <input type="text" id="txtDestination" value="UP Diliman, Quezon City, NCR, Philippines" style="width: 250px" />      
        </div>

        <div class="col-md-3">
         <h3>Fuel Rate: </h3>
           <select id="gastype">
          
              <option value="diesel">Diesel</option>
              <option value="gasoline">Gasoline</option>
            </select>
                <input type="button" value="Get Route" onclick="GetRoute()" /><br>
        </div>

        <div class="col-md-3">
            <h3> mpg: in L/km </h3><input type="text" id=carsz> <br>
        </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-md-0">
                  <div id="dvDistance">
            </div>
            <div class="col-md-12">
            <center>
                  <div id="dvMap" style="width: 1000px; height: 900px">
                </div>
                </center>
            </div>
        </div>
    </div>
</div> <!-- end of div class backColor -->

<fieldset>
<u><center><h3>Graphs</center></u>>

<canvas id="myChart2" style="width:100%; height:400px"></canvas>

</fieldset>

<fieldset>
<u><center><h3>Logs</h3><center></u>
<?php foreach($query as $querykey): ?>
<table border=0>
  <tr>
    <td>You have traveled <?php echo $querykey['km']; ?>
      km and have used <?php echo $querykey['fuel_used']; ?>
      Liters and have cost <?php echo $querykey['fuel_cost']; ?>php on <?php echo date('M-d-Y h:i:s', strtotime($querykey['date_created'])); ?>
      <a href="fuel_delete.php?action=delete&id=<?php echo $querykey['id'] ?>">Delete</a>
    </td>
  </tr>
</table>
<?php endforeach; ?>
</fieldset>



</body>
</html>
