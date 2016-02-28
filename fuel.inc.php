<?php
require_once('core/init.php');

if(isset($_POST['km']) && isset($_POST['fuel_used'])) {
	$km = $_POST['km'];
	$fuel_used = $_POST['fuel_used'];
	if(!empty($km) && !empty($fuel_used)) {
		DB::query()->insert_with_date("fuel/user_id, km, fuel_used, date_created/1, $km, $fuel_used: NOW()");
		header('Location: '.$referer);
	}
}
?>


