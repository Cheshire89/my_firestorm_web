<?php 
	require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
     header('Location: /');
     exit();
}

	$events = new Events();
	if(isset($_POST["deleteEvents"]) && $_POST["deleteEvents"]){
		$deleteArr = $_POST["deleteEvents"];
		foreach($deleteArr as $deleteID){
		   $events->deleteEvent(intval($deleteID));
		}
    }
?>