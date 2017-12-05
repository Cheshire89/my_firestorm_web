<?php 
	require_once('classes/config.php');
	$articles = new Education();
	if(isset($_POST["deleteArticles"]) && $_POST["deleteArticles"]){
		$deleteArr = $_POST["deleteArticles"];
		foreach($deleteArr as $deleteID){
		   $articles->deleteArticle(intval($deleteID));
		}
    }
?>