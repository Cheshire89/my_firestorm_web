<?php 
	require_once("classes/config.php");
	$chapter = new Chapters();
	if(isset($_POST["userID"]) && $_POST["userID"] != "" && isset($_POST["chapterID"]) && $_POST["chapterID"] != ""){
		$result = $chapter->setChapterAdmin($_POST["userID"], $_POST["chapterID"]);
		print($result);
	}
?>