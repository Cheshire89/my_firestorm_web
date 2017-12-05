<?php 
	require_once('classes/config.php');
	$banner = new Banners();
	if(isset($_POST['bannerID']) && $_POST["bannerID"] != ''){
		$result = $banner->update_banner($_POST, $_FILES);
		if($result){
		header('Location: '.$_POST["pageName"].'.php?banner=updated');
		exit();
		}
	}else{
		$result = $banner->save_banner($_POST, $_FILES);
		header('Location: '.$_POST["pageName"].'.php?banner=saved');
	    exit();
	}
?>