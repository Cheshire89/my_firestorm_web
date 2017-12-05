<?php 
	require_once('classes/config.php');
	$checkUser = new User_Valid();
	if(!$checkUser->isLoggedIn()){
	    header('Location: /');
	    exit();
	}

	if(isset($_POST["eventID"]) && $_POST["eventID"] != ''){
		$eventID = $_POST["eventID"];
		$gallery = new Sponsors();

		if(isset($_POST["imgID"]) && $_POST["imgID"] != ''){
			$result = $gallery->update_image($_POST, $_FILES);
				header('Location: createEvent.php?eventID='.$eventID.'&sponsor=update');
				exit();
		}else{
			$result = $gallery->save_image($_POST, $_FILES);
				header('Location: createEvent.php?eventID='.$eventID.'&sponsor=save');
				exit();
		}
	}
?>