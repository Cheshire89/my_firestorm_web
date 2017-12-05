<?php
	require_once('classes/config.php');
	if(isset($_FILES) && isset($_GET["userID"]) && $_GET["userID"] != ''){
		$file = new Users();
		$file->saveField(key($_FILES),$_FILES,'file','users', $_GET["userID"]);
	}else{
		print('Error');
	}
?>