<?php require_once('core/init.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>CO2 Awareness Calculator</title>
<meta name="description" content="Ecotransit App">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme <-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link rel="stylesheet" href="custom.css">
<link rel="stylesheet" href="bike.css">
<link rel="stylesheet" href="custom@media.css">
<link href='https://fonts.googleapis.com/css?family=Ubuntu|Lato' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>
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
      </nav>  <!-- end of navbar-->
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

    <section class="inner_cover">
      <div class="container">
        <h3 class="biketitle">BIKE SHARING SYSTEM</h3>

          <div class="container">
            <br>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src="images/bike1.png" alt="Bike" width="460" height="345">
                </div>

                <div class="item">
                  <img src="images/bike2.jpg" alt="Bike" width="460" height="345">
                </div>
              
                <div class="item">
                  <img src="images/bike3.jpg" alt="Bike" width="460" height="345">
                </div>

              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div><!-- carousel -->

          </div>

      </div> <!--container -->
    </section>

    <section class="yellow_cover">
      <div class="row">
        <div class="dark_yellow">
        </div>
      </div>
        <div class="OpenSansFont">
        <h3 class="biketitle2">Bike Sharing System</h3>
        <p class="biketext">The Metropolitan Manila Development Authority (MMDA) relaunched its expanded bike-sharing program on Tuesday (December 8), in another attempt at giving relief to frustrated commuters.</p><br>
        <p class="biketext">MMDA Chairman Emerson Carlos said 40 new bikes were set aside for interested pedestrians and commuters.
        These bikes can be borrowed and used as alternative transport during heavy traffic.</p><br>
        <p class="biketext">Designated bike lanes are in the Ortigas Area to White Plains, Temple Drive and Santolan near Camp Aguinaldo; Rajah Solayman in Kalaw, at the corner of Museong Pambata going to Quirino Grandstand in Manila; and Ayala going to Magallanes.</p><br>
        <br>
        </div>
        <a href="http://www.bikesharingworld.com" target="blank"><input type="button" class="btn btn-success btn-bike" value="Go to Bike-Sharing Map"></a>
    </section>
 
     <section class="violet_cover">
        <div class="row">
          <div class="dark_violet">
          </div>
          <div class="OpenSansFont">
           <h3 class="biketitle2">Bike-Kadahan</h3>
           <p class="biketext">The bike-sharing initiative is part of the MMDA’s “Bike-Kadahan” project which started in March last year to promote bicycles as an alternative mode of transportation and at the same time, provide a safe parking spot for bikers.<p><br>
           <p class="biketext">TIt opened a bike lane on the northbound lane of Edsa from Magallanes to Ayala in Makati City. Two more followed in Quezon City: from Ortigas to Santolan (northbound) and from White Plains to Temple Drive. <p><br>
           <p class="biketext">T The MMDA also introduced the Bike-Kadahan project on the Ateneo de Manila University campus in October in a bid to ease traffic in the area.<p><br>
           <p class="biketext">TMMDA General Manager Cora Jimenez earlier said that the MMDA was planning to open more bike lanes to connect the different cities in the metropolis. <p><br>
          </div> <!-- opensans --> 
        </div> <!--row-->
    </section>

<!-- Latest compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- Include js plugin -->
<script>
$(document).ready(function(){


$(window).resize(function() {
if ($(window).width() < 770) {
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
