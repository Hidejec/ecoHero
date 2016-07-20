<?php require_once('core/init.php'); 


if ($_SERVER['REQUEST_METHOD'] &&
	isset($_POST['username_login']) &&
	isset($_POST['password_login'])) {
	$username=$_POST['username_login'];
	$password=$_POST['password_login'];
	$password_hash=md5($password);
	
	if (!empty($username) &&
		!empty($password)) {
		$query = DB::query()->select_rowCount("users/*", "username=$username, password=$password_hash");

		if($query) {

			$_SESSION['user_id'] = DB::query()->getuser_id($username);
			header('Location: '.$referer);
		} else {
			echo 'Wrong username and password combination!';
		}
	}	
}
?>