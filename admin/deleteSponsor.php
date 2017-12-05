<?php 
	require_once('classes/config.php');
	if(isset($_POST["imgId"]) && $_POST["imgId"]!=''){
		$chapterGallery = new Sponsors();
		$result = $chapterGallery->delete_img($_POST["imgId"]);
		print_r($result);
	}
?>