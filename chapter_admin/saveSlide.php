<?php

require_once('classes/config.php');

$slides =  new Slides();

if(isset($_POST["slideId"]) && $_POST["slideId"] != ""){
	$added = $slides->updateSlide($_POST,$_FILES);
	if($added){
		$success = true;
	}
}else{
	$added = $slides->saveSlide($_POST,$_FILES);
	if($added != "") {
	   $sucess = true;
	}else{
	   $sucess = false;
	}
}

if($sucess) {
	header('Location: ./?success=yes');
}else{
	header('Location: ./?success=failed');
}
exit();

?>