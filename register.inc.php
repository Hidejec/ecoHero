<?php require_once('core/init.php'); 

if (!loggedin()) {

	if ($_SERVER['REQUEST_METHOD'] &&
		isset($_POST['username_register']) &&
		isset($_POST['password_register']) &&
		isset($_POST['repassword_register']) &&
		isset($_POST['name_register'])) {
		$username=$_POST['username_register'];
		$password=$_POST['password_register'];
		$repassword=$_POST['repassword_register'];
		$password_hash=md5($password);
		$name=$_POST['name_register'];

		if (!empty($username) &&
			!empty($password) &&
			!empty($repassword) &&
			!empty($name)) {
			if ($password===$repassword) {
				if(!DB::query()->exist("users/username", "username=$username")) {
					DB::query()->insert("users/username, password, name/$username, $password_hash, $name");
					header('Location: index.php');

				} else {
					//echo 'username already exist';
				}


			} else {
				//echo 'Password doesn\'t match!';
			}
		} 
	}
}
?>