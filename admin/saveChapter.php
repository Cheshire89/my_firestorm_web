<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$chapters =  new Chapters();
if(isset($_POST["chapterID"]) && $_POST["chapterID"] != ""){
	$action = "update";
	$added = $chapters->updateChapter($_POST,$_FILES);
	if($added){
		$action =  'chapterID='.$_POST["chapterID"].'&update';
		$success = true;
	}
}else{
	$added = $chapters->saveChapter($_POST,$_FILES);
	if($added != "") {
	   $success = true;
	   $action = 'chapterID='.$added.'&save';

	}else{
	   $action = 'create';
	   $success = false;
	}
}

if($success) {
	header('Location: ./createChapter.php?'.$action.'=success');
}else{
	header('Location: ./createChapter.php?'.$action.'=failed');
}

exit();
?>