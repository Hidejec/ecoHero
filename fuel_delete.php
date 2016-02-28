<?php
require_once('core/init.php');

if(isset($_GET['id']) && isset($_GET['action'])) {
	$id = $_GET['id'];
	$action = $_GET['action'];
	if(!empty($id) && !empty($action)) {
		switch($action) {
			case 'delete': {DB::query()->delete("fuel", "id=$id"); header('Location: '.$referer);}
				break;
		}
	}
}
?>