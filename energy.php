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
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="style.css" />
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/graph.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/weatherjs/weather.js"></script>
    <script src="js/sugar.js"></script>
    <script src="Chartjs/Chart.js"></script>
	
</head>
<body>

<form method="post" action='energy.php'>
<table border=2>
	<tr>
		<td></td>
		<td>Quantity
		</td>
		<td>Tons(Annually)
		</td>
	</tr>

	<tr>
		<td>small car
		</td>
		<td><input type="text" name="namesmallcar" value="">
		</td>
		<td><input type="text" readonly="readonly" value="">
		</td>
	</tr>
 
 		<td>medium car
		</td>
		<td><input type="text" name="namemediumcar" onchange="compute()">
		</td>
		<td><input type="text" readonly="readonly" value="<?php echo @$mediumcar ?>">
		</td>
	</tr>

	<tr>
		<td>large car
		</td>
		<td><input type="text" name="namelargecar" onchange="compute()">
		</td>
		<td><input type="text" readonly="readonly" value="<?php echo @$largecar ?>">
		</td>
	</tr>

	<tr>
		<td>electricity usage
		</td>
		<td><input type="text" name="nameelectricity" onchange="compute()">
		</td>
		<td><input type="text" readonly="readonly" value="<?php echo @$electricity ?>">
		</td>
	</tr>

	<tr>
		<td>natural/prophane gas usage
		</td>
		<td><input type="text" name="namegas" onchange="compute()">
		</td>
		<td><input type="text" readonly="readonly" value="<?php echo @$gas ?>">
		</td>
	</tr>

	<tr>
		<td>air travel
		</td>
		<td><input type="text" name="nameair" onchange="compute()">
		</td>
		<td><input type="text" readonly="readonly" value="<?php echo @$air ?>">
		</td>
	</tr>

	<tr>
		<td>train travel
		</td>
		<td><input type="text" name="nametrain" onchange="compute()">
		</td>
		<td><input type="text" readonly="readonly" value="<?php echo @$train ?>">
		</td>
	</tr>

	<input type=submit value=Convert name="submit">


</form>
</table>
<h1>Orange is your last </h1>
<h1>Blue is your latest </h1>
<select id="date_created" >
	<option value="0">Choose Date</option>
	<?php foreach($query as $querykey): ?>
		<option value="<?php echo $querykey['id']; ?>"><?php echo date('M-d-Y h:i:s', strtotime($querykey['date_created'])) ?></option>
	<?php endforeach; ?>
</select>
<div style="width:100%;"> 
	<canvas id="myChart" style="width:100%; height: 400px"></canvas>
</div>

</body>
</html>
