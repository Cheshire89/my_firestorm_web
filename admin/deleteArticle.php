<?php 

	require_once("classes/config.php");

    $checkUser = new User_Valid();
    if(!$checkUser->isLoggedIn()){
        header('Location: /');
        exit();
    }
    
	$articles = new Education();
	if(isset($_POST["deleteArticles"]) && $_POST["deleteArticles"]){
		$deleteArr = $_POST["deleteArticles"];
		foreach($deleteArr as $deleteID){
		   $articles->deleteArticle(intval($deleteID));
		}
    }
?>