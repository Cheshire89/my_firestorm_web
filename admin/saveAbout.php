<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$about = new About();
$success = $about->updateAbout($_POST,$_FILES);

if($success) {
	header('Location: ./about.php?success=yes');
}else{
	header('Location: ./about.php?success=failed');
}

exit();

?>