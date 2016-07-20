<?php
session_start();

$callTo = @$_GET['callTo'];

function loggedin() {
	if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
		return true;
	} else {
		return false;
	}
}
if(isset($_POST['btn2out'])){
	session_destroy();
}

/*if($callTo == "login") {
	$_SESSION['user_id'] = @$_GET['id'];
	
}
else if($callTo == "logout"){
	session_destroy();
}*/

@$current_page = @$_SERVER['SCRIPT_NAME'];
@$referer = @$_SERVER['HTTP_REFERER'];

require_once('functions/functions.php')

?>