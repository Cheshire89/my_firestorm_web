<?php 
	require_once('classes/config.php');
	$chapters = new Chapters();
	if(isset($_POST["deleteChapters"]) && $_POST["deleteChapters"]){
		$deleteArr = $_POST["deleteChapters"];
		foreach($deleteArr as $deleteID){
		   $chapters->deleteChapter(intval($deleteID));
		}
    }
?>