<?php
require_once 'init.php';

function __autoload($class_name){
	require_once "$class_name.php";
}

class Controller extends Database implements iController{


	public function getLastId($id){
		$query = "SELECT id FROM `energy` WHERE user_id = '$id' ORDER BY id ASC";
		$result = mysql_query($query, $this->getConnection());
		$data;
		while($row = mysql_fetch_array($result)){
			$data = $row[0];
		}
		return $data;
	}
	public function getLastId2($id){
		$query = "SELECT id FROM `fuel` WHERE user_id = '$id' ORDER BY id ASC";
		$result = mysql_query($query, $this->getConnection());
		$data;
		while($row = mysql_fetch_array($result)){
			$data = $row[0];
		}
		return $data;
	}
	public function __construct(){

		$callTo = $_GET['callTo'];

		if($callTo == "energy"){
			if(isset($_SESSION['user_id'])){
				$id = $_SESSION['user_id'];	
			}
			else{
				$id = 0;
			}
			$lastId = $this->getLastId($id);
			$query = "SELECT smallcar, mediumcar, largecar, electricity, gas, air, train FROM `energy` WHERE user_id = '$id' AND id='$lastId'";
			$result = mysql_query($query, $this->getConnection());
			$data1 = array();
			while($row = mysql_fetch_object($result)){
				$data1[][] = $row;
			}

			$beforelastId = $this->getLastId($id) -1;
			$query = "SELECT smallcar, mediumcar, largecar, electricity, gas, air, train FROM `energy` WHERE user_id = '$id' AND id='$beforelastId'";
			$result = mysql_query($query, $this->getConnection());
			while($row = mysql_fetch_object($result)){
				$data1[][] = $row;
			}

			echo json_encode($data1);
		}
		else if($callTo == "compare"){
			
			if(isset($_SESSION['user_id'])){
				$id = $_SESSION['user_id'];	
			}
			else{
				$id = 0;
			}
			$lastId = $this->getLastId($id);
			$query = "SELECT smallcar, mediumcar, largecar, electricity, gas, air, train FROM `energy` WHERE user_id = '$id' AND id='$lastId'";
			$result = mysql_query($query, $this->getConnection());
			$data1 = array();
			while($row = mysql_fetch_object($result)){
				$data1[][] = $row;
			}
			$optionId = $_GET['optionId'];
			$query = "SELECT smallcar, mediumcar, largecar, electricity, gas, air, train FROM `energy` WHERE user_id = '$id' AND id='$optionId'";
			$result = mysql_query($query, $this->getConnection());
			while($row = mysql_fetch_object($result)){
				$data1[][] = $row;
			}
			echo json_encode($data1);
		}
		else if($callTo == "gas"){
			$id = $_SESSION['user_id'];
			$distance = $_GET['distance'];
			$fuelused = $_GET['fuelused'];
			$fuelcost = $_GET['fuelcost'];
			DB::query()->insert_with_date("fuel/user_id, km, fuel_used, fuel_cost, date_created/$id, $distance, $fuelused, $fuelcost: NOW()");
			//$query = "INSERT INTO `fuel`(user_id, km, fuel_used, fuel_cost) VALUES ('$id', $distance', '$fuelused', '$fuelcost'";
			//$result = mysql_query($query, $this->getConnection());
			echo "Sucessful";
		}
		else if($callTo == "gas2"){

			if(isset($_SESSION['user_id'])){
				$id = $_SESSION['user_id'];	
			}
			else{
				$id = 0;
			}
			$lastId = $this->getLastId2($id);
			$query = "SELECT fuel_used, fuel_cost FROM `fuel` WHERE user_id = '$id' AND id='$lastId'";
			$result = mysql_query($query, $this->getConnection());
			$data1 = array();
			while($row = mysql_fetch_object($result)){
				$data1[] = $row;
			}
			echo json_encode($data1);
		}
	}

}
new Controller();

