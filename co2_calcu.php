<?php 
require_once('core/init.php');
$id = @$_SESSION['user_id'];
$query = DB::query()->select_fetch("energy/id, date_created", "user_id=$id");
if(isset($_POST['submit']) &&
  isset($_POST['namesmallcar']) &&
   isset($_POST['namemediumcar']) &&
   isset($_POST['namelargecar']) &&
   isset($_POST['nameelectricity']) &&
   isset($_POST['namegas']) &&
   isset($_POST['nameair']) &&
   isset($_POST['nametrain'])) {
    $smallcar = $_POST['namesmallcar'];
    $mediumcar = $_POST['namemediumcar'];
    $largecar = $_POST['namelargecar'];
    $electricity = $_POST['nameelectricity'];
    $gas = $_POST['namegas'];
    $air = $_POST['nameair'];
    $train = $_POST['nametrain'];
    if(!empty($smallcar) ||
       !empty($mediumcar) ||
       !empty($largecar) ||
       !empty($electricity) ||
       !empty($gas) ||
       !empty($air) ||
       !empty($train)){

      $smallcar = $smallcar * (0.354/100);
      $mediumcar = $mediumcar * (0.66/100);
      $largecar = $largecar * (0.942/100);
      $electricity = $electricity * (0.9/100);
      $gas = $gas * (0.01968/100);
      $air = $air * (0.582/100);
      $train = $train * (0.27/100);

      $treesmallcar=$smallcar*5;
      $treemediumcar=$mediumcar*5;
      $treelargecar=$largecar*5;
      $treeelectricity=$electricity*5;
      $treegas=$gas*5;
      $treeair=$air*5;
      $treetrain=$train*5;

      

      $total_co2_anually = $smallcar + $mediumcar+ $largecar + $electricity + $gas + $air + $train;
      $total_co2_monthly = $treesmallcar + $treemediumcar+ $treelargecar + $treeelectricity + $treegas + $treeair + $treetrain;
      $total_tree_anually = $total_co2_anually/12;
      $total_tree_monthly = $total_tree_anually/12;
      $id = @$_SESSION['user_id'];
      DB::query()->insert_with_date("energy/user_id, smallcar, mediumcar, largecar, electricity, gas, air, train, total_co2_anually, total_co2_monthly, total_tree_anually, total_tree_monthly, date_created/$id, $smallcar, $mediumcar, $largecar, $electricity, $gas, $air, $train, $total_co2_anually, $total_co2_monthly, $total_tree_anually, $total_tree_monthly: NOW()");
      
   }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>CO2 Awareness Calculator</title>
<meta name="description" content="Ecotransit App">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
<script src="/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme <-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <script src="js/jquery.js"></script>
  <script src="js/graph.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/weatherjs/weather.js"></script>
    <script src="js/sugar.js"></script>
    <script src="Chartjs/Chart.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link rel="stylesheet" href="custom2.css">
<link rel="stylesheet" href="custom.css">
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
        <div class="OpenSansFont">
          <div class="green_color">
            <h1>Carbon dioxide emission calculator</h1>
            <br>
            <p>This carbon dioxide emission calculator will help you gain an approximate idea of how many tons 
            of carbon dioxide some of your activities generate and how many trees it would take to offset 
            those emissions </p>
          </div> <!--green-->

          <div class="calculator">
            <div class="lightblue">
              <div class="row">
                <div class="col-xs-6">
                  <p><center>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspQuantity</center></p>
                </div>
                <div class="col-xs-6">
                  <p><center>Total tons of CO2 annualy</center></p>
                </div>
              </div>
            </div> <!--lightblue-->
              <div class="calcu-content">
                <div class="row">

                  <div class="col-md-4">
                    <p>Small Car<br>(40 mpg fuel)</p>
                    <br><br>
                    <p>Average Car<br>(21 mpg fuel)</p>
                    <br><br>
                    <p>SUV/4 Wheel Drive<br>(15 mpg fuel)</p>
                    <br><br>
                    <p>Electricity Usage</p>
                    <br><br>
                    <p>Natural/Propane Gas</p>
                    <br><br>
                    <p>Fuel oil heating</p>
                    <br><br>
                    <p>Air travel</p>
                    <br><br>
                    <p>Train Travel</p>
                    <br><br>
                  </div> <!--col md 4 -->
                  <form method="post" action='co2_calcu.php'>
                  <div class="col-md-4">
                    <input type="text" name="namesmallcar" class="box" placeholder="miles/month"><br><br><br><br>
                    <input type="text" name="namemediumcar" class="box" placeholder="miles/month"><br><br><br><br>
                    <input type="text" name="namelargecar" class="box" placeholder="miles/month"><br><br><br><br>
                    <input type="text" name="nameelectricity" class="box" placeholder="kwh/month"><br><br><br><br>
                    <input type="text" name="namegas" class="box" placeholder="cubicfeet/month"><br><br><br><br>
                    <input type="text" name="nameair" class="box" placeholder="miles/month"><br><br><br><br>
                    <input type="text" name="nametrain" class="box" placeholder="miles/month"><br><br><br><br>
                  </div>

                  <div class="col-md-4">
                    <input type="text" readonly="readonly" name="smallcarton" class="box" value="<?php echo @$smallcar ?>"><br><br><br><br>
                    <input type="text" readonly="readonly" name="averagecarton" class="box" value="<?php echo @$mediumcar ?>"><br><br><br><br>
                    <input type="text" readonly="readonly" name="suvton" class="box" value="<?php echo @$largecar ?>"><br><br><br><br>
                    <input type="text" readonly="readonly" name="electricityton" class="box" value="<?php echo @$electricity ?>"><br><br><br><br>
                    <input type="text" readonly="readonly" name="gaston" class="box" value="<?php echo @$gas ?>"><br><br><br><br>
                    <input type="text" readonly="readonly" name="airton" class="box" value="<?php echo @$air ?>"><br><br><br><br>
                    <input type="text" readonly="readonly" name="trainton" class="box" value="<?php echo @$train ?>"><br><br><br><br>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                    <p>Total Annual Emissions</p><br>
                    <p>Total Monthly Emissions</p><br>
                    <p>No. of trees to offset per year</p><br>
                    <p>No. of trees to offset per month</p><br>                    
                  </div>

                  <div class="col-md-6">
                    <input type="text" readonly="readonly" name="annual" class="box" value="<?php echo @$total_co2_anually ?>"><br> <br>  
                    <input type="text" readonly="readonly" name="monthly" class="box" value="<?php echo @$total_co2_monthly ?>"><br><br>
                    <input type="text" readonly="readonly" name="treeyear" class="box" value="<?php echo @$total_tree_anually ?>"><br><br>
                    <input type="text" readonly="readonly" name="treemonth" class="box" value="<?php echo @$total_tree_monthly ?>"><br>  <br>      
                  </div>

                </div> <!--row-->

                 <div class="lightblue">
                    <input type="submit" class="btn-compute" value="COMPUTE" name="submit">
                 </div> <!--lighblue -->

                  </form>
              </div>    <!--calcu-content-->
          </div><!--calcu-->

        </div> <!-- font -->
      </div> <!--container -->
    </section>

    <section class="yellow_cover">
      <div class="row">
        <div class="dark_yellow">
        </div>
      </div>
          <!-- INSERT GRAPH -->
          <br>
          <br>
          <select id="date_created" >
            <option value="0">Choose Date</option>
            <?php foreach($query as $querykey): ?>
              <option value="<?php echo $querykey['id']; ?>"><?php echo date('M-d-Y h:i:s', strtotime($querykey['date_created'])) ?></option>
            <?php endforeach; ?>
          </select>
          <br>
          <br>
          <br>
          <br>
          <br>
          <div style="width:100%;"> 
            <canvas id="myChart" style="width:100%; height: 400px"></canvas>
          </div>
    </section>
 
     <section class="violet_cover">
        <div class="OpenSansFont">
          <div class="row">

            <div class="col-md-6">
              <div class="facts">
                <h4 class="factstitle">Carbon Facts</h4>
                <p class="facttext">1. CO2 concentrations have risen by 25% to possibly over 39% over the last century.<br><br>
                2. CO2 can be neutralized by trees.<br><br>
                4. CO2 makes plants more resistant to extreme weather.<br><br>
                5. CO2 makes trees healthier and easier to manage.<br><br>
                6. Increased CO2 levels can help trees, that are properly managed, grow in drought conditions by increasing photosynthesis.<br><br>
                7. 100 metric tons of CO2 can accumulate in one acre of forest over time.<br><br>
                8. Each person generates approximately 2.3 tons of CO2 per year.<br><br>
                9. The carbon footprints of 18 average Americans can be neutralized by one acre of hardwood trees.<br><br>
                10. Managed forests accumulate more carbon per acre than unmanaged forests.</p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="facts">
                <h4 class="factstitle">Tree Facts</h4>
                <p class="facttext">1. A single tree can absorb CO2 at a rate of 48 lb. per year.
                    <br><br>
                    2. Trees act as natural pollution filters by absorbing
                        pollutants through the stomates in leaf surfaces.
                    <br><br>      
                    3. Trees lower temperature by transpiring water and 
                        shading surfaces.
                    <br><br>    
                    4. Trees reduce heat sinks. Heat sinks are 6-19 degrees
                        Farenheit warmer than the surrounding area.
                   <br><br>   
                    5. Trees reduce erosions.
                    <br><br>
                    6. An acre of trees absorbes enough CO2 over one year 
                        to equal the amount produced by driving a car 26,000
                        miles.
                    <br><br>  
                    7. Trees provide food and wildlife habitats.
                    <br><br>
                    8. Planting trees remains one of the cheapest, most 
                    effective means of drawing excess CO2 from the 
                    atmosphere.
                    <br><br>
                    9. Trees recharge ground water and sustain stream flow.
                    <br><br>
                    10. One large tree strategically placed in a yard can 
                          replace 10 room-size air conditioners operating 20
                          hours per day.</p>
              </div>
            </div>

            <div class="dark_violet">
            </div>

          </div> <!--row-->
        </div> <!-- opensans -->
    </section>

    <section class="blue_cover">
      <div class="OpenSansFont">
        <div class="row">
        <div class="dark_blue">
        </div>
          <div class="treelinks">
          <h3>Links for Tree Planting</h3>
          <br>
          <p><a class="treelinks" href="http://ngp.denr.gov.ph">National Greening Program</a></p>
          <br>
          <p><a class="treelinks" href="http://www.weforest.org/projects/philippines">WeForest</a></p>
          <br>
          <p><a class="treelinks" href="http://www.energy.com.ph/our-social-and-environmental-commitment/binhi/">Binhi</a></p>
          <br>
          <p><a class="treelinks" href="http://nuvali.ph/see-and-do/parks-and-nature/tree-planting-activity/">Novali Evoliving</a></p>
          <br>
          </div>
        </div>
      </div>
    </section>

<!-- Latest compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- Include js plugin -->
<script>
$(document).ready(function(){

/* hides the logo */

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
