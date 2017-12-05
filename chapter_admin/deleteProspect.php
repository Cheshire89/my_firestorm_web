<?php 
	require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
     header('Location: /');
     exit();
}

	if(isset($_POST["prospectID"]) && $_POST["prospectID"] != ""){
		$user = new Users();
		$id = $_POST["prospectID"];
		$result = $user->delete_prospect($_POST["prospectID"]);
	}
?>