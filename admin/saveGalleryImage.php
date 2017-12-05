<?php 
	require_once('classes/config.php');
	$checkUser = new User_Valid();
	if(!$checkUser->isLoggedIn()){
	    header('Location: /');
	    exit();
	}

	if(isset($_POST["chapterID"]) && $_POST["chapterID"] != ''){
		$chapterID = $_POST["chapterID"];
		$gallery = new ChapterGallery();

		if(isset($_POST["imgID"]) && $_POST["imgID"] != ''){
			$result = $gallery->update_image($_POST, $_FILES);
				header('Location: createChapter.php?chapterID='.$chapterID.'&gallery=update');
				exit();
		}else{
			$result = $gallery->save_image($_POST, $_FILES);
				header('Location: createChapter.php?chapterID='.$chapterID.'&gallery=save');
				exit();
		}
	}
?>