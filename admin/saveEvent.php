<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}
$events =  new Events();

if(isset($_POST["eventID"]) && $_POST["eventID"] != ""){

	$added = $events->updateEvent($_POST,$_FILES);
    //print("tmp: ".$_FILES['eventImg']["tmp_name"]);
    $action = 'eventID='.$_POST["eventID"].'&update';

    //print($added);
	if($added){
		$success = true;
	}
}else{
    $action = "save";
	$added = $events->saveEvent($_POST,$_FILES);

	if($added != "") {
	   $success = true;
	   $action = 'eventID='.$added.'&save';
	}else{
	   $success = false;
	}
}

if($success) {
	header('Location: ./createEvent.php?'.$action.'=success');
}else{
	header('Location: ./createEvent.php?'.$action.'=failed');
}

exit();
?>