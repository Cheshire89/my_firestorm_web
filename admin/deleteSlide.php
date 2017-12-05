<?php 

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$slides = new Slides();

if(isset($_POST["slideID"]) && $_POST["slideID"] != ""){
	$delete = $slides->deleteSlide($_POST["slideID"]);
	if($delete != 0 && $delete != -1){
		print('true');
	}else{
		print('false');
	}
}

// if($success) {
// 	 header('Location: ./?delete=yes');
// }else{

// 	header('Location: ./?delete=failed');
// }

// exit();

?>