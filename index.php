<?php require_once('core/init.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="style.css" />
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/weatherjs/weather.js"></script>
    <script src="js/weather.js"></script>
    <script src="js/sugar.js"></script>
    <script src="Chartjs/Chart.js"></script>
    <script src="http://openlayers.org/api/OpenLayers.js"></script>
    <script src="http://openweathermap.org/js/OWM.OpenLayers.1.3.4.js"></script>
    
<head>
<meta charset="utf-8">
<title>EcoTransit App</title>
<meta name="description" content="Ecotransit App">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme <-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- custom CSS -->
<link rel="stylesheet" href="custom.css">
<link rel="stylesheet" href="custom@media.css">
<!-- lnk to FONTS and font-Icons -->
<link href='https://fonts.googleapis.com/css?family=Ubuntu|Lato' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>
<div class="img-responsive bback">
    					<!-- START OF NAVBAR-->
    	<nav class="navbar navbar-custom navbar-fixed-top" data-spy="affix" data-offset-top="1">
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
           <h5>Or Login Using: </h5>
           <a href="#"><i class="fa fa-facebook-official"></i></a>   
           <input type="hidden" value = "" id="isFBLoggedIn" />
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

 
  <div id="background-top">
        <img src="images/EcoLogo.png" class="img-responsive" id="fixedSize">
  </div>

<img src="images/cars.png" id="cars" class="img-responsive">



<div class="container wellywell">
    <div class="row">
        <div class="col-md-4">
            <div class="well">EcoTransit App is a lorem ipsum dolor blablablabla</div>
        </div>
        <div class="col-md-4">
            <div class="well">B</div>
        </div>
        <div class="col-md-4">
            <div class="well">C</div>
        </div>
    </div>
</div>
</div>
<!-- Latest compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- Include js plugin -->
<script>
$(document).ready(function(){

/* hides the logo */

$(window).resize(function() {
if ($(window).width() < 828) {
  $(".pull-left").hide(100);

}
else {
 $(".pull-left").show(100);
}
});


});
</script>
</body>
</html>
