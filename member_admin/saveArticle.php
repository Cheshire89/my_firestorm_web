<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
     header('Location: /');
     exit();
}

$education =  new Education();

if(isset($_POST["articleID"]) && $_POST["articleID"] != ""){
	$action = "update";
	$added = $education->updateArticle($_POST,$_FILES);
	if($added){
		$action = 'articleID='.$_POST["articleID"].'&update';
		$success = true;
	}
}else{
	$added = $education->saveArticle($_POST,$_FILES);
	if($added != "") {
	   $success = true;
	   $action = 'articleID='.$added.'&save';
	}else{
	   $success = false;
	   $action = 'save';
	}
}

if($success) {
	header('Location: ./createArticle.php?'.$action.'=success');
}else{
	header('Location: ./createArticle.php?'.$action.'=failed');
}

exit();
?>