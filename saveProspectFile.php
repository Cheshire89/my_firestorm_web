<?php
	require_once('classes/config.php');
	$file = new Users();
	if($_FILES && isset($_SESSION["prospectID"]) && $_SESSION["prospectID"] != ''){
		$prospectID = $_SESSION["prospectID"];
		$file->saveField(key($_FILES),$_FILES,'file','prospects', $prospectID);
	}
?>