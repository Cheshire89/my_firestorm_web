<?php 
	require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
     header('Location: /');
     exit();
}

	if(isset($_POST["prospectID"]) && $_POST["prospectID"] != ''){
		$user = new Users();
		$prospectID = $_POST["prospectID"];
		$result = $user->admin_convert_prospect($prospectID);
	}
?>